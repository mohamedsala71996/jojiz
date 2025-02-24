<?php
namespace Database\Seeders;

use Database\Seeders\GeneralSettingSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SliderSeeder::class,
            GeneralSettingSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            ChildCategorySeeder::class,
            AttributeNameSeeder::class,
            BrandSeeder::class,
            ProductAttributeSeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            OfferSeeder::class,
            ModuleSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            MailConfigarationSeeder::class,

            CouponSeeder::class,
            ShippingAddressSeeder::class,
            PaymentCredentialSeeder::class,
            CurrencySeeder::class,
            UsefulLinkSeeder::class,
            AlertAppSeeder::class,

            DelivaryChargeSeeder::class,
            FAQSeeder::class,
            OtherDeliveryChargeSeeder::class,

        ]);
    }
}
