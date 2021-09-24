<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Topping extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getToppingsFromArray(array $toppingIds): Collection
    {
        return collect($toppingIds)->transform(fn($toppingId) => self::find($toppingId));
    }
}
