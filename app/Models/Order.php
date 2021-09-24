<?php

namespace App\Models;

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
}
