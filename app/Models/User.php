<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'wallet'                => MoneyCast::class,
        'discord_mention'       => 'bool',
        'enable_whatsapp'       => 'bool',
        'phone_number_verified' => 'bool',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function phoneVerification(): HasOne
    {
        return $this->hasOne(PhoneVerification::class);
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

    public function shouldSendWhatsappMessage()
    {
        return $this->phone_number && $this->phone_number_verified && $this->enable_whatsapp;
    }

    public function getPhoneNumberWithoutPrefixAttribute()
    {
        return substr($this->phone_number, 3);
    }

    public function hasValidPhoneVerificationCode(): bool
    {
        return $this->phoneVerification()->count() === 1;
    }
}
