<?php

namespace Database\Seeders;

use App\Models\Admin\ChildCategory;
use Illuminate\Database\Seeder;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $child_categories = array(
            array('id' => '1','subcategory_id' => '4','name' => 'Jeans','slug' => 'jeans','image' => 'public/backend/images/childcategory/seeder/DRPUSTERECKG.jpeg','status' => '1','created_at' => NULL,'updated_at' => '2024-07-16 09:28:34'),
            array('id' => '2','subcategory_id' => '4','name' => 'Logitech','slug' => 'logitech','image' => 'public/backend/images/childcategory/seeder/OEDQHTDRDOWU.jpeg','status' => '1','created_at' => '2024-07-16 09:04:05','updated_at' => '2024-07-16 09:28:22')
          );

            ChildCategory::insert($child_categories);
    }
}
