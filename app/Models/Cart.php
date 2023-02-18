<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Money\Money;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['cartlines'];

    public function cartLines(): HasMany
    {
        return $this->hasMany(CartLines::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPriceAttribute()
    {
        $price = new \Cknow\Money\Money();

        foreach ($this->cartLines as $cartLine) {
            $item  = $cartLine->item;
            $price = $price->add($item->price->multiply($cartLine->quantity));
        }

        return $price;
    }

    public function getItemsAttribute(): Collection
    {
        return $this->cartLines->transform(fn($cartLine) => [
            'name'        => $cartLine->item->name,
            'description' => $cartLine->item->description,
            'price'       => $cartLine->item->price,
            'quantity'    => $cartLine->quantity,
            'toppings'    => Topping::getToppingsFromArray($cartLine->toppings),
            'total_price' => $cartLine->quantity * $cartLine->item->price,
        ]);
    }

    public function addItem(Item $item, $quantity = 1, $toppings = null)
    {
        $cartLine = $this->cartLines->where('item_id', $item->id)->first();
        if (! $item->hasToppings() && $cartLine) {
            if ($cartLine->quantity >= 20) {
                return;
            }

            $cartLine->quantity++;
            $cartLine->save();

            return;
        }

        CartLines::create([
            'cart_id'  => $this->id,
            'item_id'  => $item->id,
            'quantity' => $quantity,
            'toppings' => is_array($toppings) && ! empty($toppings) ? json_encode($toppings) : null,
        ]);
    }

    public static function importFromOrder(Order $order)
    {
        $cart = $order->user->cart;

        foreach ($order->orderLines as $orderLine) {
            $toppings = [];
            if ($orderLine->toppings) {
                foreach (json_decode($orderLine->toppings) as $topping) {
                    $toppingModel = Topping::find($topping);
                    if ($toppingModel && $toppingModel->active) {
                        $toppings[] = $topping;
                    }
                }
            }

            $item = Item::find($orderLine->item_id);
            if (! $item || ! $item->active || ! $item->type->active) {
                continue;
            }

            $cart->addItem($item, $orderLine->quantity, $toppings);
        }
    }
}
