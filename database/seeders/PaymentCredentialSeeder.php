<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_credentials')->insert([
            [
                'gateway' => 'sslcommerz',
                'image'=>'public/backend/images/payment/seeder/sslcommerz.png',
                'credentials' => json_encode([
                    'store_id' => 'arcad6692144ea0330',
                    'store_password' => 'arcad6692144ea0330@ssl',
                    'currency' => 'BDT',
                    'is_localhost' => 'sandbox'
                ]),
            ],
            [
                'gateway' => 'stripe',
                'image'=>'public/backend/images/payment/seeder/stripe.png',
                'credentials' => json_encode([
                    'secret_key' => 'sk_test_51PiCTw2LxqAFKorFvSTVNYQ5i44CmNMvr8yscMVmXgTefkgyMzr0dxvUmNB5HmW3BlVOiLGfNzjKuEwAi7pftcPV00vTNf4esk',
                    'publishable_key' => 'pk_test_51PiCTw2LxqAFKorFSr1Tih1deXRHbhTNxj8uKwxAsnp9vHD8zKCCocGDTlcVtMDRuR6v9ukyqvA2K8EL0ZtRFaiu00GkzbJIB1',
                    'currency' => 'BDT',
                    'is_localhost' => 'sandbox'
                ]),
            ],
            [
                'gateway' => 'cash_on_delivary',
                'image'=>'public/backend/images/payment/seeder/cashondelivery.png',
                'credentials' => json_encode([
                    'app_key' => null,
                    'publishable_key' => null,
                    'currency' => 'BDT',
                    'is_localhost' => 'sandbox'
                ]),
            ],
            [
                'gateway' => 'bkash',
                'image'=>'public/backend/images/payment/seeder/bkash.jpg',
                'credentials' => json_encode([
                    'app_key' => '4f6o0cjiki2rfm34kfdadl1eqq',
                    'app_secret' => '2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b',
                    'username' => 'sandboxTokenizedUser02',
                    'password' => 'sandboxTokenizedUser02@12345',
                    'currency' => 'BDT',
                    'is_localhost' => 'sandbox'
                ]),
            ],
            [
                'gateway' => 'razorpay',
                'image'=>'public/backend/images/payment/seeder/razorpay.png',
                'credentials' => json_encode([
                    'RAZORPAY_ID_KEY' => 'rzp_test_qsWJIMAXJe3Eul',
                    'RAZORPAY_SECRET_KEY' => 'sjNUv8uvI3K0kNvUMlW0JvxI',
                    'currency' => 'INR',
                    'is_localhost' => 'sandbox'
                ]),
            ],
            [
                'gateway' => 'paypal',
                'image'=>'public/backend/images/payment/seeder/paypal.png',
                'credentials' => json_encode([
                    'client_id' => 'AVx2vxI7l3qjPneN6CS88nPjkdGVc9QFkBv5VrAgS2zNN9sgU3KMRnkcjcq3RHG3UvyDPht8o2219Rhv',
                    'secret' => 'EI9I2L85uAnrHaLZAfwESHUD1nZM6yGcnxE9_KmvSOp6EUf7ABbd1GyZi_MGNm6NxEnz0-gJWit3Ygee',
                    'currency' => 'USD',
                    'is_localhost' => 'sandbox'
                ]),
            ],

        ]);
    }
}
