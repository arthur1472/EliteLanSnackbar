<?php

namespace App\Models;

use App\Events\OrderCreatedEvent;
use App\Events\OrderUpdatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        $lines = $this->orderLines->map(fn($orderLine) => [
            'price' => $orderLine->quantity * $orderLine->item->price,
        ]);

        return $lines->sum('price');
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
        $order = Order::create([
            'user_id'   => $cart->user_id,
            'status_id' => Status::NIEUW,
            'user_note' => $note,
        ]);

        foreach ($cart->cartLines as $cartLine) {
            OrderLine::create([
                'order_id' => $order->id,
                'item_id'  => $cartLine->item_id,
                'quantity' => $cartLine->quantity,
                'toppings' => $cartLine->toppings,
            ]);

            $cartLine->delete();
        }

        $cart->delete();
    }

    protected $dispatchesEvents = [
        'created' => OrderCreatedEvent::class,
        'updated' => OrderUpdatedEvent::class,
    ];
}
