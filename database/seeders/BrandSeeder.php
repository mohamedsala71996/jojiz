<?php

namespace Database\Seeders;

use App\Models\Admin\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = array(
            array('id' => '1','name' => 'Apex','slug' => 'nike','image' => 'public/backend/images/brand/seeder/Apex.jpg','desc' => 'This is more beautiful brand.','status' => '1','created_at' => '2024-06-29 10:18:52','updated_at' => '2024-08-10 09:54:48'),
            array('id' => '2','name' => 'Bay','slug' => 'bay','image' => 'public/backend/images/brand/seeder/Bay.jpg','desc' => 'Bay is the best product.','status' => '1','created_at' => '2024-08-04 11:51:45','updated_at' => '2024-08-10 09:55:31'),
            array('id' => '3','name' => 'Lacaste','slug' => 'lacaste','image' => 'public/backend/images/brand/seeder/Lacoste.jpg','desc' => 'The best brand for cloths','status' => '1','created_at' => '2024-08-10 10:05:06','updated_at' => '2024-08-10 10:05:06'),
            array('id' => '4','name' => 'Puma','slug' => 'puma','image' => 'public/backend/images/brand/seeder/Puma.jpg','desc' => 'The popular brand in the world','status' => '1','created_at' => '2024-08-10 10:05:33','updated_at' => '2024-08-10 10:05:33'),
            array('id' => '5','name' => 'Bata','slug' => 'bata','image' => 'public/backend/images/brand/seeder/Bata.jpg','desc' => 'The best brand','status' => '1','created_at' => '2024-08-10 10:05:57','updated_at' => '2024-08-10 10:05:57'),
            array('id' => '6','name' => 'Sailor','slug' => 'sailor','image' => 'public/backend/images/brand/seeder/Sailor.jpg','desc' => 'The best brand','status' => '1','created_at' => '2024-08-10 10:05:57','updated_at' => '2024-08-10 10:05:57'),
            array('id' => '8','name' => 'Citizen','slug' => 'citizen','image' => 'public/backend/images/brand/seeder/JOXJOYEDAYVM.jpg','desc' => 'The Best Luxury Watch','status' => '1','created_at' => '2024-10-14 18:47:40','updated_at' => '2024-10-14 18:47:40'),
            array('id' => '16','name' => 'Fastrack','slug' => 'fastrack','image' => 'public/backend/images/brand/seeder/NYBNGSRXNMMW.png','desc' => 'This is Popular Brand','status' => '1','created_at' => '2024-10-18 04:55:38','updated_at' => '2024-10-18 04:55:38'),
          );


          Brand::insert($brands);
    }
}
