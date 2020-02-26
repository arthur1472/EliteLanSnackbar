<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function snack() {
        return $this->belongsToMany(Snack::class)->withPivot('amount', 'price');
    }
}
