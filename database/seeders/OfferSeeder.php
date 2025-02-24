<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offers')->insert([
            [
                'title' => 'Winter Sale',
                'sub_title' => 'Up to 30% off on all items',
                'image' => 'public/backend/images/offer/seeder/promo2.jpg',

            ],
            [
                'title' => 'Buy One Get One Free',
                'sub_title' => 'Best time for purchase',
                'image' => 'public/backend/images/offer/seeder/promo3.jpg',

            ],
            [
                'title' => 'Summer Sale',
                'sub_title' => 'Best time for purchase',
                'image' => 'public/backend/images/offer/seeder/promo1.jpg',

            ],
            [
                'title' => 'Black Friday Sale',
                'sub_title' => 'Best time for purchase',
                'image' => 'public/backend/images/offer/seeder/promo4.jpg',

            ]

        ]);

        $offerCollection = Offer::find(1);
        $offerCollection->products()->sync([1]);

    }
}
