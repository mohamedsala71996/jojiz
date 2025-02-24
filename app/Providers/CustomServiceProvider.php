<?php
namespace App\Providers;

use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Currency;
use App\Models\Admin\Product;
use App\Models\AlertApp;
use App\Models\Coupon;
use App\Models\GeneralSetting;
use App\Models\OtherDeliveryCharge;
use App\Models\UsefulLink;
use App\Models\User\Notification;
use Exception;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        try {
            $view_share                          = [];
            $view_share['basic_setting']         = GeneralSetting::first();
            $view_share['privacyPolicy']         = UsefulLink::where('slug', 'privacy-policy')->first();
            $view_share['returnPolicy']          = UsefulLink::where('slug', 'return-policy')->first();
            $view_share['alertApp']              = AlertApp::first();
            $view_share['currency']              = Currency::first();
            $view_share['products']              = Product::get();
            $view_share['categories']            = Category::get();
            $view_share['other_delivery_charge'] = OtherDeliveryCharge::first();
            $view_share['brands']                = Brand::get();
            $view_share['notifications']         = Notification::with('user')->latest()->get();
            $view_share['coupons']               = Coupon::latest()->get();

            view()->share($view_share);
        } catch (Exception $e) {
            //
        }
    }
}
