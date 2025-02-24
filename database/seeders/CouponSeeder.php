<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = array(
            array('id' => '1','code' => 'EID2024','type' => 'Amount','amount' => '60','coupon_type' => 'global','date' => '2024-07-06','validity' => '2025-07-31','status' => 'Active','created_at' => '2024-07-06 11:05:57','updated_at' => '2024-07-06 11:05:57'),
            array('id' => '2','code' => 'W80','type' => 'Percent','amount' => '50','coupon_type' => 'category','date' => '2024-12-18','validity' => '2024-12-31','status' => 'Active','created_at' => '2024-12-18 10:38:40','updated_at' => '2024-12-18 10:38:40')
          );


        Coupon::insert($coupons);

    }
}
