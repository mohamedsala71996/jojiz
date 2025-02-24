<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlertAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alert_apps')->insert([
            [
                'title' => 'Summer Sale Alert',
                'discount' => '20%',
                'type' => 'Promotion',
                'image' => '',
                'expire_time' => '2024-08-31',
                'link' => 'https://arcadexit.com',
                'active'=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
