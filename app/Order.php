<?php

namespace App;

use App\Events\OrderUpdatedEvent;
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

    public function getSnacksInfoAttribute() {
        $snacksInfo = [
            'snacks' => [],
            'total_snacks' => 0,
            'total_price' => 0,
        ];
        $this->snack->each(function ($snack) use (&$snacksInfo) {
            $price = $snack->pivot->price;
            $amount = $snack->pivot->amount;

            $snacksInfo['snacks'][] = [
                'id' => $snack->id,
                'name' => $snack->name,
                'price' => $price,
                'amount' => $amount,
            ];

            $snacksInfo['total_snacks'] += $amount;
            $snacksInfo['total_price'] += ($price * $amount);
        });

        return $snacksInfo;
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => OrderUpdatedEvent::class,
    ];
}
