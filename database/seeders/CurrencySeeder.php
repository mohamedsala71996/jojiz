<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            DB::table('currencies')->insert([
                // [
                //     'admin_id' => 1, // Adjust based on your actual admin IDs
                //     'country' => 'Bangladesh',
                //     'name' => 'Taka',
                //     'code' => 'BDT',
                //     'symbol' => '৳',
                //     'flag' => 'public/backend/images/currency/seeder/bd-flag.png',
                //     'rate' => 120.00000000,
                //     'default' => true,
                //     'status' => true,
                //     'created_at' => now(),
                //     'updated_at' => now(),
                // ],
                [
                    'admin_id' => 1, // Adjust based on your actual admin IDs
                    'country' => 'United States',
                    'name' => 'US Dollar',
                    'code' => 'USD',
                    'symbol' => '$',
                    'symbol_position' => 'left',
                    'image' => 'public/backend/images/currency/seeder/us-flag.png',
                    'rate' => 1.00000000,
                    'default' => true,
                    'status' => true,
                ]
            ]);
        }
    }
}
