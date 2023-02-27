<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class CartLines extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function item(): BelongsTo
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
            if ($toppingModel->active) {
                $toppingModels->add($toppingModel);
            }
        }

        return $toppingModels;
    }
}
