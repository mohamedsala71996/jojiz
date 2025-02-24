<?php

namespace Database\Seeders;

use App\Models\Admin\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_attributes = array(
            array('id' => '1','name' => 'No Color','value' => '1','color_code' => NULL,'attribute_name_id' => '1','status' => '1','created_at' => '2024-06-29 09:52:09','updated_at' => '2024-06-29 09:52:09'),
            array('id' => '2','name' => 'No Size','value' => '2','color_code' => NULL,'attribute_name_id' => '2','status' => '1','created_at' => '2024-06-29 09:52:09','updated_at' => '2024-06-29 09:52:09'),
            array('id' => '3','name' => 'No Weight','value' => '3','color_code' => NULL,'attribute_name_id' => '3','status' => '1','created_at' => '2024-06-29 09:52:09','updated_at' => '2024-06-29 09:52:09'),
            array('id' => '4','name' => 'Black','value' => '1','color_code' => '#000000','attribute_name_id' => '1','status' => '1','created_at' => '2024-06-10 08:36:02','updated_at' => '2024-06-10 08:36:02'),
            array('id' => '6','name' => 'Blue','value' => '1','color_code' => '#0000FF','attribute_name_id' => '1','status' => '1','created_at' => '2024-06-10 08:38:55','updated_at' => '2024-06-10 08:38:55'),
            array('id' => '7','name' => 'Gray','value' => '1','color_code' => '#808080','attribute_name_id' => '1','status' => '1','created_at' => '2024-06-10 08:39:07','updated_at' => '2024-06-10 08:39:07'),
            array('id' => '8','name' => 'XXL','value' => '2','color_code' => NULL,'attribute_name_id' => '2','status' => '1','created_at' => '2024-06-10 08:39:20','updated_at' => '2024-06-10 08:39:20'),
            array('id' => '9','name' => 'XL','value' => '2','color_code' => NULL,'attribute_name_id' => '2','status' => '1','created_at' => '2024-06-10 08:39:36','updated_at' => '2024-06-10 08:39:36'),
            array('id' => '10','name' => 'L','value' => '2','color_code' => NULL,'attribute_name_id' => '2','status' => '1','created_at' => '2024-06-10 08:39:46','updated_at' => '2024-06-10 08:39:46'),
            array('id' => '11','name' => 'M','value' => '2','color_code' => NULL,'attribute_name_id' => '2','status' => '1','created_at' => '2024-06-10 08:40:02','updated_at' => '2024-06-10 08:40:02'),
            array('id' => '12','name' => 'S','value' => '2','color_code' => NULL,'attribute_name_id' => '2','status' => '1','created_at' => '2024-06-10 08:40:11','updated_at' => '2024-06-10 08:40:11'),
            array('id' => '15','name' => 'Red','value' => '1','color_code' => '#ff0000','attribute_name_id' => '1','status' => '1','created_at' => '2024-08-10 06:57:21','updated_at' => '2024-08-10 06:57:21'),
            array('id' => '16','name' => 'White','value' => '1','color_code' => '#ffffff','attribute_name_id' => '1','status' => '1','created_at' => '2024-08-10 09:48:41','updated_at' => '2024-08-10 09:48:41'),
            array('id' => '17','name' => '5kg','value' => '3','color_code' => NULL,'attribute_name_id' => '3','status' => '1','created_at' => '2024-08-13 09:08:49','updated_at' => '2024-08-13 09:08:49'),
            array('id' => '18','name' => 'Navy Blue','value' => '1','color_code' => '#000080','attribute_name_id' => '1','status' => '1','created_at' => '2024-09-28 05:56:09','updated_at' => '2024-09-28 05:56:09'),
            array('id' => '19','name' => 'Orange','value' => '1','color_code' => '#fff700','attribute_name_id' => '1','status' => '1','created_at' => '2024-12-18 05:29:17','updated_at' => '2024-12-18 05:29:17')
          );


        ProductAttribute::insert($product_attributes);
    }
}
