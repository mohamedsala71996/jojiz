<?php

namespace Database\Seeders;

use App\Models\Admin\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sliders = array(
            array('id' => '1','sub_heading' => 'Latest Update Stock','heading' => '30% Off On Electronics','desc' => 'Find electronics on best prices, Also Discover most selling products of electronics','starting_amount' => '1050.00','button_text' => 'SHOP NOW','button_link' => 'https://arcadexit.com/','image' => 'public/backend/images/slider/seeder/Fashion_2_1110x360.jpg','created_at' => '2024-06-08 05:58:21','updated_at' => '2024-06-08 05:58:21'),
            array('id' => '2','sub_heading' => 'Find Top Brands','heading' => '10% Off On Electronics','desc' => 'Find electronics on best prices, Also Discover most selling products of electronics','starting_amount' => '1050.00','button_text' => 'SHOP NOW','button_link' => 'https://arcadexit.com/','image' => 'public/backend/images/slider/seeder/Fashion_1_1110x360.jpg','created_at' => '2024-06-08 06:03:50','updated_at' => '2024-06-08 06:03:51'),
            array('id' => '3','sub_heading' => 'Find Top Brands','heading' => '10% Off On Electronics','desc' => 'Find electronics on best prices, Also Discover most selling products of electronics','starting_amount' => '1050.00','button_text' => 'SHOP NOW','button_link' => 'https://arcadexit.com/','image' => 'public/backend/images/slider/seeder/Fashion_2_1110x360.jpg','created_at' => '2024-06-08 06:04:59','updated_at' => '2024-06-08 06:05:01'),
          );

          Slider::insert($sliders);

    }
}
