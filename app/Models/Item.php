<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $this->toppings->filter(fn ($filterTopping) => $topping->id === $filterTopping->id)->count();
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
