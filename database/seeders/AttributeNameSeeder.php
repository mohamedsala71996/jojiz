<?php

namespace Database\Seeders;

use App\Models\AttributeName;
use Illuminate\Database\Seeder;

class AttributeNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributeName = [
            'Color',
            'Size',
            'Weight',
            'Code',

        ];
        foreach($attributeName as $item){
            AttributeName::insert([
                'name'=>$item
            ]);
        }
    }
}
