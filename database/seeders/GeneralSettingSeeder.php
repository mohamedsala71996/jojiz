<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $general_settings = array(
            array(
                "id" => 1,
                "site_name" => "E-Commerce",
                "site_title" => "The best collaction",
                "web_version" => "2.0.1",
                "site_logo" => "default-logo.png",
                "site_favicon" => "VFDXEMGHUOFJ.png",
                "phone" => "01512345678",
                "email" => "contact@arcadexit.com",
                "address" => "Gulshan-1, Dhaka",
                "facebook_pixel" => NULL,
                "google_analytics" => NULL,
                "chat_box" => NULL,
                "delivary_charge" => "50",
                "vat" => 0.00,
                "advance_payment" => 100.00,
                "advance_payment_type" => "fixed",
                "delivery_charge_type" => "order_wise",
                "advance_payment_title" => "You Can Advance Payment",
                "vat_status" => "OFF",
                "tax" => 0.00,
                "tax_status" => "OFF",
                "cash_on_delivery" => "ON",
                "online_payment" => "ON",
                "facebook" => "https://facebook.com",
                "twitter" => "https://www.twitter.com",
                "google" => "https://www.google.com",
                "rss" => NULL,
                "pinterest" => "https://www.pintarest.com",
                "linkedin" => "https://www.linkedin.com",
                "youtube" => "https://www.youtube.com",
                "app_store" => "https://play.google.com/store/apps",
                "apple_store" => "https://www.apple.com/store",
                "meta_title" => NULL,
                "meta_description" => NULL,
                "meta_keyword" => NULL,
                "meta_image" => NULL,
                "created_at" => NULL,
                "updated_at" => "2024-07-02 11:13:37",
            ),
        );


        GeneralSetting::insert($general_settings);
    }
}
