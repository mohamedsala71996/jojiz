<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $store_id = 'arcad6692144ea0330';
    private $store_password = 'arcad6692144ea0330@ssl';
    private $url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';

    public function pay(Request $request)
    {
        $client = new Client();
        $response = $client->post('https://sandbox.sslcommerz.com/gwprocess/v4/api.php', [
            'form_params' => [
                'store_id' =>  $credentials['store_id'] ?? env("SSLCZ_STORE_ID"),
                'store_passwd' => $credentials['store_password'] ?? env("SSLCZ_STORE_PASSWORD"),
                'total_amount' => 100,
                'currency' => 'BDT',
                'tran_id' => uniqid(),
                'success_url' => route('api.success'),
                'fail_url' => route('api.fail'),
                'cancel_url' => route('api.cancel'),
                'emi_option' => 0,
                'cus_name' => 'Customer Name',
                'cus_email' => 'customer@example.com',
                'cus_add1' => 'Customer Address',
                'cus_city' => 'Dhaka',
                'shipping_method' => 'NO', // Shipping method
                'product_name' => 'Product Name', // Added this line
                'product_category' => 'Product Category', // Added this line
                'product_profile' => 'general', // Added this line
                'cus_postcode' => '1000',
                'cus_country' => 'Bangladesh',
                'cus_phone' => '01711111111',
                'ship_name' => 'Ship Name',
                'ship_add1' => 'Ship Address',
                'ship_city' => 'Dhaka',
                'ship_postcode' => '1000',
                'ship_country' => 'Bangladesh',
                'value_a' => 'Additional Value A',
                'value_b' => 'Additional Value B',
                'value_c' => 'Additional Value C',
                'value_d' => 'Additional Value D',
            ],
        ]);

        $result = json_decode($response->getBody(), true);


        if (isset($result['GatewayPageURL']) && $result['GatewayPageURL'] != "") {
            return redirect($result['GatewayPageURL']);
        } else {
            return redirect('/')->with('error', 'Payment session creation failed.');
        }
    }

    public function success(Request $request)
    {

        // Handle success
        $data = $request->all();
        // Verify the transaction
        $validation = $this->orderValidation($data['val_id']);
        if ($validation['status'] == 'VALID') {
            // Update order status
            return view('payment.success', compact('data'));
        } else {
            return redirect('/')->with('error', 'Payment validation failed.');
        }
    }

    public function fail(Request $request)
    {
        // Handle fail
        $data = $request->all();
        return view('payment.fail', compact('data'));
    }

    public function cancel(Request $request)
    {
        // Handle cancel
        $data = $request->all();
        return view('payment.cancel', compact('data'));
    }

    private function orderValidation($val_id)
    {
        $url = "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php";

        $client = new Client();
        $response = $client->get($url, [
            'query' => [
                'val_id' => $val_id,
                'store_id' => $this->store_id,
                'store_passwd' => $this->store_password,
                'format' => 'json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

}
