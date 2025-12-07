<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'max_redemptions',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isValid()
    {
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        if ($this->max_redemptions && $this->redemptions >= $this->max_redemptions) {
            return false;
        }

        return true;
    }

    public function calculateDiscount($subtotal)
    {
        if ($this->discount_type === 'percent') {
            return $subtotal * ($this->discount_value / 100);
        } elseif ($this->discount_type === 'fixed') {
            return min($this->discount_value, $subtotal);
        }

        return 0;
    }

    public function redemptions()
    {
        return $this->hasMany(Order::class)->where('discount_amount', '>', 0);
    }

    public function getRedemptionsAttribute()
    {
        return $this->redemptions()->count();
    }
}
