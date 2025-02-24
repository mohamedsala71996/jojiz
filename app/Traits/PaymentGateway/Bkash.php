<?php
namespace App\Traits\PaymentGateway;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

trait Bkash
{
    protected function getAccessToken()
    {
        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'bkash')
            ->first()->credentials;
        $paymentCredentials = json_decode($paymentCredentials);
        if ($paymentCredentials->is_localhost == 'live') {
            $payment_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/token/grant';
        } else {
            $payment_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/token/grant';
        }

        try {
            $client = new Client();
            $response = $client->request('POST',  $payment_url, [
                'body' => json_encode([
                    'app_key' => $paymentCredentials->app_key,
                    'app_secret' => $paymentCredentials->app_secret,

                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'password' => $paymentCredentials->password,
                    'username' => $paymentCredentials->username,

                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            if (isset($responseData['id_token'])) {
                return $responseData['id_token'];
            } else {
                throw new \Exception("Unable to retrieve access token.");
            }
        } catch (\Exception $e) {
            
            // Handle the error for both website and API
            return response()->json(['error' => 'Error fetching access token: ' . $e->getMessage()], 500);
        }
    }
}
