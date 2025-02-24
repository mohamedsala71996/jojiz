<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class PaymentCredentialsServiceProvider extends ServiceProvider
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

        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'sslcommerz')
            ->first();

        if ($paymentCredentials && isset($paymentCredentials->credentials)) {
            $credentials = json_decode($paymentCredentials->credentials, true);

            if (is_array($credentials)) {
                $storeId = $credentials['store_id'] ?? null;
                $storePassword = $credentials['store_password'] ?? null;
                $isLocalhost = $credentials['is_localhost'] ?? false; // Default to false if not set

                // Set the config values dynamically
                Config::set('sslcommerz.apiCredentials.store_id', $storeId);
                Config::set('sslcommerz.apiCredentials.store_password', $storePassword);
                Config::set('sslcommerz.apiDomain', $isLocalhost ? "https://sandbox.sslcommerz.com" : "https://securepay.sslcommerz.com");
                Config::set('sslcommerz.connect_from_localhost', $isLocalhost);
            } else {
                throw new \Exception('Invalid credentials format.');
            }
        } else {
            throw new \Exception('Payment credentials not found.');
        }
    }
}
