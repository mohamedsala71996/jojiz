<?php
namespace Database\Seeders;

use App\Models\ShippingAddress;
use Illuminate\Database\Seeder;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shipping_addresses = [
            [
                "user_id"         => 1,
                "name"            => "The Cave",
                "email"           => "cave@gmail.com",
                "phone"           => "01531180095",
                "selected_area"   => "Dhaka",
                "address"         => "Gulshan",
                "city"            => "Dhaka",
                "district"        => "Dhaka",
                "delivery_charge" => 50,
            ],
        ];
        ShippingAddress::insert($shipping_addresses);
    }
}
