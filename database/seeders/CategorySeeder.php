<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            array('id' => '1','category_name' => 'Man','slug' => 'man','type' => 'special','image' => 'public/backend/images/category/seeder/Cetagory_Men.jpeg','status' => '1','category_desc' => 'The best man collaction','created_at' => NULL,'updated_at' => '2024-06-29 09:52:09','order' => '0'),
            array('id' => '2','category_name' => 'Woman','slug' => 'woman','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Women.jpg','status' => '1','category_desc' => 'The best woman collaction','created_at' => NULL,'updated_at' => '2024-06-29 09:53:34','order' => '0'),
            array('id' => '3','category_name' => 'Toys','slug' => 'toys','type' => 'not_special','image' => 'public/backend/images/category/seeder/Category_Toys.jpg','status' => '1','category_desc' => 'The best toys collaction','created_at' => NULL,'updated_at' => '2024-06-29 09:53:34','order' => '0'),
            array('id' => '4','category_name' => 'Electronics Device','slug' => 'electronics-device','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Electronics.jpg','status' => '1','category_desc' => 'The best electronics device collaction','created_at' => NULL,'updated_at' => '2024-06-29 09:54:15','order' => '0'),
            array('id' => '5','category_name' => 'Sport','slug' => 'sport','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Sports.jpg','status' => '1','category_desc' => 'The best sport collection','created_at' => '2024-07-28 10:21:32','updated_at' => '2024-07-28 10:21:32','order' => '0'),
            array('id' => '6','category_name' => 'Home Appliances','slug' => 'home-appliances','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Home_Appliance.jpg','status' => '1','category_desc' => 'The best home appliances collection','created_at' => '2024-07-28 10:23:16','updated_at' => '2024-07-28 10:23:16','order' => '0'),
            array('id' => '7','category_name' => 'Pets','slug' => 'pets','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Pets.jpg','status' => '1','category_desc' => 'The best pet cloths collection','created_at' => '2024-07-28 10:28:17','updated_at' => '2024-07-28 10:28:17','order' => '0'),
            array('id' => '8','category_name' => 'Health','slug' => 'health','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Health.jpg','status' => '1','category_desc' => 'The best health accessories collection','created_at' => '2024-07-28 10:36:51','updated_at' => '2024-07-28 10:36:51','order' => '0'),
            array('id' => '9','category_name' => 'Beauty','slug' => 'beauty','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Beauty.jpg','status' => '1','category_desc' => 'The best beauty accessories collection','created_at' => '2024-07-28 10:37:58','updated_at' => '2024-07-28 10:37:58','order' => '0'),
            array('id' => '10','category_name' => 'Kids','slug' => 'kids','type' => 'not_special','image' => 'public/backend/images/category/seeder/Cetagory_Kids.jpg','status' => '1','category_desc' => 'The best kids accessories collection','created_at' => '2024-07-28 10:39:18','updated_at' => '2024-07-28 10:39:18','order' => '0'),
            array('id' => '11','category_name' => 'Watches','slug' => 'watches','type' => 'not_special','image' => 'public/backend/images/category/seeder/JXXDCVKVEJQP.png','status' => '1','category_desc' => 'Discover stylish and functional watches that combine elegance with advanced features for every occasion','created_at' => '2024-10-07 16:49:25','updated_at' => '2024-10-13 15:01:55','order' => '0'),
            array('id' => '12','category_name' => 'Cameras','slug' => 'cameras','type' => 'not_special','image' => 'public/backend/images/category/seeder/VZECASFBFPMD.png','status' => '1','category_desc' => 'Explore top-quality cameras and accessories for capturing every moment with precision and clarity at unbeatable prices','created_at' => '2024-10-13 06:17:32','updated_at' => '2024-10-13 07:30:28','order' => '0')
          );
        Category::insert($categories);
    }
}
