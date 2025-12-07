<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'code' => 'SAVE10',
            'description' => '10% off on all orders',
            'discount_type' => 'percent',
            'discount_value' => 10,
            'max_redemptions' => 100,
        ]);

        Coupon::create([
            'code' => 'FIXED50',
            'description' => '₱50 off on orders over ₱500',
            'discount_type' => 'fixed',
            'discount_value' => 50,
            'max_redemptions' => 50,
        ]);
    }
}
