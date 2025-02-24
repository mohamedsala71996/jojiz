<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OtherDeliveryChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('other_delivery_charges')->insert([
            [
                'normal_delivery_fee' => 200.00,
                'normal_delivery_duration' => '3-5 business days',
                'express_delivery_fee' => 500.00,
                'express_delivery_duration' => '1-2 business days',
                'pick_up_our_place_fee' => 0.00,
                'pick_up_our_place_duration' => 'Same day',
                'free_shipping_fee' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
