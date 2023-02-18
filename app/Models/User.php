<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'wallet' => MoneyCast::class,
    ];

    protected $auditInclude = [
        'wallet',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getCartAttribute()
    {
        $cart = Cart::where('user_id', $this->id)->first();

        if ($cart) {
            return $cart;
        }

        return Cart::create([
            'user_id' => $this->id,
        ]);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                         ->logOnly(['wallet']);
    }
}
