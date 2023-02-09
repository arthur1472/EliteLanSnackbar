<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemType extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $with = [
        'items',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class)->active();
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
