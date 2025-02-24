<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentCredential;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class PaymentInfoController extends Controller
{
    public function paymentType()
    {
        // Example of specific cases for different gateways
        $specificGateways = [
            [
                'status' => 'SSLcommerz',
                'value' => 'sslcommerz',
            ],
            [
                'status' => 'Stripe',
                'value' => 'stripe',
            ],
            [
                'status' => 'Cash On Delivery',
                'value' => 'cash_on_delivery',
            ],
            [
                'status' => 'bKash',
                'value' => 'bkash',
            ],
            [
                'status' => 'RazorPay',
                'value' => 'razorpay',
            ],
            [
                'status' => 'PayPal',
                'value' => 'paypal',
            ],

        ];

        $paymentGateway = PaymentCredential::get()->map(function ($item, $index) use ($specificGateways) {
            $gatewayIndex = $index % count($specificGateways);
            return [
                'gateway' => $item->gateway,
                'image' => $item->image,
                'active' => $item->status,
                'status' => $specificGateways[$gatewayIndex]['status'], // Assuming status is a field in your model
                'value' => $specificGateways[$gatewayIndex]['value'], // Assuming value is related to gateway field
            ];
        });
        $basic_setting = GeneralSetting::first();
        if($basic_setting->advance_payment_type == 'product_wise'){
            $advance_payment = Cart::where('user_id',auth()->user()->id)->sum('advance_payment_amount');

        }else{
            $advance_payment = $basic_setting->advance_payment;

        }

        $data = [
            'type' => $paymentGateway,
            'advance_payment_status' => $basic_setting->advance_payment_status,
            'advance_payment' =>(string) $advance_payment,
            'advance_payment_type' => $basic_setting->advance_payment_type,
            'advance_payment_title' => $basic_setting->advance_payment_title,

        ];
        return ApiResponse::created('Payment Type list and image', $data);
    }

}
