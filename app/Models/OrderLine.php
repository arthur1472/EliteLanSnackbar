<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderLine extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'line_price'  => MoneyCast::class,
        'total_price' => MoneyCast::class,
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getToppingModelsAttribute()
    {
        if (! $this->toppings) {
            return null;
        }

        $toppingModels = collect();

        foreach (json_decode($this->toppings) as $topping) {
            $toppingModel = Topping::find($topping);
            $toppingModels->add($toppingModel);
        }

        return $toppingModels;
    }
}
