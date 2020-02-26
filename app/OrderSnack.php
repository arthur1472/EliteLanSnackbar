<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderSnack extends Pivot
{
    protected $guarded = [
        'id'
    ];
}
