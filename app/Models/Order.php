<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Events\OrderCreatedEvent;
use App\Events\OrderUpdatedEvent;
use Cknow\Money\Money;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'total_price' => MoneyCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function getPriceAttribute()
    {
        $price = new \Cknow\Money\Money();

        foreach ($this->orderLines as $orderLine) {
            $price = $price->add($orderLine->total_price);
        }

        return $price;
    }

    public function scopeNew($query)
    {
        return $query->where('status_id', '=', 1);
    }

    public function scopePrepare($query)
    {
        return $query->where('status_id', '=', 2);
    }

    public function scopeReady($query)
    {
        return $query->where('status_id', '=', 3);
    }

    public function getItemsAttribute(): Collection
    {
        return $this->orderLines->transform(fn($orderLine) => [
            'name'        => $orderLine->item->name,
            'description' => $orderLine->item->description,
            'price'       => $orderLine->item->price,
            'quantity'    => $orderLine->quantity,
            'toppings'    => Topping::getToppingsFromArray($orderLine->toppings),
            'total_price' => $orderLine->quantity * $orderLine->item->price,
        ]);
    }

    public static function importFromCart(Cart $cart, $note = null)
    {
        $orderLines = [];
        $orderPrice = new Money();

        foreach ($cart->cartLines as $cartLine) {
            $item               = $cartLine->item;
            $totalCartLinePrice = $item->price->multiply($cartLine->quantity);

            $orderPrice = $orderPrice->add($totalCartLinePrice);

            $lock = Cache::lock("{$item->getKey()}_stock_mutation", 10);

            try {
                $lock->block(10);

                if (! $item->isPortionsAvailable($cartLine->quantity)) {
                    continue;
                }

                $item->substractPortions($cartLine->quantity);
            } catch (LockTimeoutException $e) {
                dd($e);
                continue;
            } finally {
                $lock?->release();
            }

            $orderLines[] = [
                'item_id'     => $cartLine->item_id,
                'quantity'    => $cartLine->quantity,
                'toppings'    => $cartLine->toppings,
                'line_price'  => $item->price,
                'total_price' => $totalCartLinePrice,
            ];

            $cartLine->delete();
        }

        $order = Order::create([
            'user_id'     => $cart->user_id,
            'status_id'   => Status::NIEUW,
            'user_note'   => $note,
            'total_price' => $orderPrice,
        ]);

        foreach ($orderLines as $orderLine) {
            $orderLine['order_id'] = $order->id;
            OrderLine::create($orderLine);
        }

        $user = $cart->user;
        $user->wallet = $user->wallet->subtract($orderPrice);
        $user->save();

        $cart->delete();
    }

    protected $dispatchesEvents = [
        'created' => OrderCreatedEvent::class,
        'updated' => OrderUpdatedEvent::class,
    ];
}
