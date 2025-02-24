<?php

namespace Database\Seeders;

use App\Models\Admin\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sub_categories = array(
            array('id' => '1','category_id' => '1','name' => 'Pant','slug' => 'pant','image' => 'public/backend/images/sub-category/seeder/SCRQCBMCXOHP.jpg','created_at' => NULL,'updated_at' => '2024-07-16 09:23:50'),
            array('id' => '2','category_id' => '1','name' => 'Shirt','slug' => 'shirt','image' => 'public/backend/images/sub-category/seeder/FABZRVMJPNAB.jpg','created_at' => NULL,'updated_at' => '2024-07-16 09:22:50'),
            array('id' => '3','category_id' => '2','name' => 'Sharee','slug' => 'sharee','image' => 'public/backend/images/sub-category/seeder/DXVDFRUUPYUZ.jpg','created_at' => NULL,'updated_at' => '2024-07-16 09:21:54'),
            array('id' => '4','category_id' => '4','name' => 'Headphone','slug' => 'headphone','image' => 'public/backend/images/sub-category/seeder/UPVBQTXAGOPC.jpeg','created_at' => '2024-07-16 09:02:08','updated_at' => '2024-07-16 09:02:08'),
            array('id' => '5','category_id' => '5','name' => 'Team sport','slug' => 'team-sport','image' => 'public/backend/images/sub-category/seeder/GBYARAVZOQYP.jpg','created_at' => '2024-07-28 11:33:38','updated_at' => '2024-07-28 11:33:38'),
            array('id' => '6','category_id' => '6','name' => 'Smart TV','slug' => 'smart-tv','image' => 'public/backend/images/sub-category/seeder/ZKECRKRUQBDP.jpg','created_at' => '2024-07-28 11:36:09','updated_at' => '2024-07-28 11:36:09'),
            array('id' => '7','category_id' => '7','name' => 'Foods','slug' => 'foods','image' => 'public/backend/images/sub-category/seeder/XNUAYFUXFBUY.jpg','created_at' => '2024-07-28 11:38:23','updated_at' => '2024-07-28 11:38:23'),
            array('id' => '8','category_id' => '8','name' => 'Hair Care','slug' => 'hair-care','image' => 'public/backend/images/sub-category/seeder/ZSAANQYJPURD.jpg','created_at' => '2024-07-28 11:41:07','updated_at' => '2024-07-28 11:41:07'),
            array('id' => '9','category_id' => '9','name' => 'Cosmetic','slug' => 'cosmetic','image' => 'public/backend/images/sub-category/seeder/DNADDYOZBHSW.jpg','created_at' => '2024-07-28 11:42:05','updated_at' => '2024-07-28 11:42:05'),
            array('id' => '10','category_id' => '10','name' => 'Feeding','slug' => 'feeding','image' => 'public/backend/images/sub-category/seeder/CVTGWQZMWOCK.jpg','created_at' => '2024-07-28 11:45:18','updated_at' => '2024-07-28 11:45:18'),
            array('id' => '11','category_id' => '1','name' => 'Hoodie','slug' => 'hoodie','image' => 'public/backend/images/sub-category/seeder/WXMSCEYPEYEN.jpeg','created_at' => '2024-09-25 10:40:44','updated_at' => '2024-09-25 10:40:44'),
            array('id' => '39','category_id' => '11','name' => 'Luxury Watch','slug' => 'luxury-watch','image' => 'public/backend/images/sub-category/seeder/NNGOCURGVNHE.jpeg','created_at' => '2024-10-13 07:20:03','updated_at' => '2024-10-13 07:20:03'),
            array('id' => '40','category_id' => '6','name' => 'Blenders & Mixers','slug' => 'blenders-mixers','image' => 'public/backend/images/sub-category/YXQFHNPKVDUZ.png','created_at' => '2024-12-18 05:54:23','updated_at' => '2024-12-18 05:54:24')
          );



        SubCategory::insert($sub_categories);
    }
}
