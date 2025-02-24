<?php

namespace Database\Seeders;

use App\Models\DelivaryCharge;
use Illuminate\Database\Seeder;

class DelivaryChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DelivaryCharge::insert([
            [
                'city' => 'Dhaka',
                'amount' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city' => 'Khulna',
                'amount' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city' => 'Other',
                'amount' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
