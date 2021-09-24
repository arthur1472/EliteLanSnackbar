<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        $lines = $this->cartLines->map(fn($cartLine) => [
            'price' => $cartLine->quantity * $cartLine->item->price
        ]);

        return $lines->sum('price');
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

    public function addItem($itemId, $quantity = 1, $toppings = null)
    {
        CartLines::create([
            'cart_id'  => $this->id,
            'item_id'  => $itemId,
            'quantity' => $quantity,
            'toppings' => is_array($toppings) ? json_encode($toppings) : null,
        ]);
    }
}
