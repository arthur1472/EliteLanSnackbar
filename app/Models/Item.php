<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class Item extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ItemType::class, 'item_type_id');
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class);
    }

    public function hasToppings(): bool
    {
        return $this->toppings()->count() > 0;
    }

    public function hasTopping(Topping $topping): bool
    {
        return $this->toppings->filter(fn($filterTopping) => $topping->id === $filterTopping->id)->count();
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function isAvailableToOrder()
    {
        return $this->portionsAvailable() > 0 || $this->backorder_allowed;
    }

    public function isPortionsAvailable(int $portions)
    {
        return $this->portionsAvailable() <= $portions || $this->backorder_allowed;
    }

    public function portionsAvailable()
    {
        return floor($this->amountStockAvailable() / $this->portion_size);
    }

    public function substractPortions(int $portions)
    {
        $this->stock -= ($portions * $this->portion_size);
        $this->save();
    }

    public function amountStockAvailable()
    {
        $cartQuantities = 0;

        $cartLines = CartLines::where('item_id', $this->getKey())->get();
        $cartLines->each(function ($cartLine) use (&$cartQuantities) {
            $cartQuantities += $cartLine->quantity;
        });

        $totalStockUsed = $cartQuantities * $this->portion_size;

        return $this->stock - $totalStockUsed;
    }

}
