<?php

namespace App\Http\Controllers;

use Exception;
use Google\Client as GoogleClient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**

     * Write code on Method

     *

     * @return response()

     */

     public function initiatePayment(Request $request)
     {
         $client = new \GuzzleHttp\Client();
         $response = $client->post(config('services.orange_money.payment_url'), [
             'headers' => [
                 'Authorization' => 'Bearer ' . $this->getOrangeAccessToken(),
                 'Content-Type' => 'application/json',
             ],
             'json' => [
                 'merchant_name' => 'Your Business Name',
                 'order_id' => 'unique_order_id',
                 'amount' => $request->amount,
                 'currency' => 'XOF',
                 'return_url' => config('services.orange_money.callback_url'),
             ]
         ]);
         
         $result = json_decode($response->getBody()->getContents(), true);
         return redirect($result['payment_url']); // Redirect to Orange Money payment page
     }

     private function getOrangeAccessToken()
     {
         // Get an access token from Orange Money
         $client = new \GuzzleHttp\Client();
         $response = $client->post('https://api.orange.com/oauth/v2/token', [
             'auth' => [config('services.orange_money.client_id'), config('services.orange_money.client_secret')],
             'form_params' => [
                 'grant_type' => 'client_credentials',
             ],
         ]);

         $result = json_decode($response->getBody()->getContents(), true);
         return $result['access_token'];
     }


}
