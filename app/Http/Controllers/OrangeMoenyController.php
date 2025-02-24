<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 'orange_money' => [
//     'client_id' => env('ORANGE_MONEY_CLIENT_ID'),
//     'client_secret' => env('ORANGE_MONEY_CLIENT_SECRET'),
//     'callback_url' => env('ORANGE_MONEY_CALLBACK_URL'),
//     'payment_url' => 'https://api.orange.com/orange-money-webpay/payment',
// https://api.orange.com/orange-money-webpay/dev/payment

// ],

// ORANGE_MONEY_CLIENT_ID=Ee4vPB1DJvHEBueVyjeexiKSpsGmSUf1
// ORANGE_MONEY_CLIENT_SECRET=nWoJAA64V2Pzc029
//Authorization header=Basic RWU0dlBCMURKdkhFQnVlVnlqZWV4aUtTcHNHbVNVZjE6bldvSkFBNjRWMlB6YzAyOQ==
// ORANGE_MONEY_CALLBACK_URL=https://yourdomain.com/orange-money/callback

class OrangeMoenyController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.orange.com/orange-money-webpay/dev/payment', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getOrangeAccessToken(),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'merchant_name' => 'Shopaholic',
                'order_id' => 'sfdehaohfao',
                'amount' => 60,
                'currency' => 'XOF',
                'return_url' => "{{route('orange.money.callback'}}",
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        dd($result);
        return redirect($result['payment_url']); // Redirect to Orange Money payment page
    }

    private function getOrangeAccessToken()
    {
        // Get an access token from Orange Money
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.orange.com/oauth/v2/token', [
            'auth' => ["Ee4vPB1DJvHEBueVyjeexiKSpsGmSUf1","nWoJAA64V2Pzc029"],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['access_token'];
    }

    public function handleCallback(Request $request)
    {
        dd($request->all());
        // Verify payment status and update order
        if ($request->status === 'SUCCESS') {
            // Update order status to completed
        } else {
            // Handle failed payment
        }
    }

}
