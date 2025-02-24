<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Cart;
use App\Models\Order;
use App\Traits\PaymentGateway\Bkash;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\Notification;
use Illuminate\Support\Facades\Session;

class BkashController extends Controller
{
    use Bkash;
    public function callBack(Request $request)
    {

        $user_id = $request->query('user_id');
        $couponcode = $request->query('couponcode');
        $availablecoupon = $request->query('availablecoupon');

        $paymentID = $request->paymentID;
        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'bkash')
            ->first()->credentials;
        $paymentCredentials = json_decode($paymentCredentials);
        if ($paymentCredentials->is_localhost == 'live') {
            $payment_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/execute';
        } else {
            $payment_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/execute';
        }

        try {
            $accessToken = $this->getAccessToken();

            $client = new Client();
            $response = $client->post($payment_url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                    'X-APP-Key' => $paymentCredentials->app_key, // Add X-APP-Key header here
                ],
                'body' => json_encode(['paymentID' => $paymentID]),
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            // if (isset($responseData['transactionStatus']) && $responseData['transactionStatus'] == 'Completed') {
                // Delete cart and reset session
                $order_transaction_id = $responseData['merchantInvoiceNumber'];
                $order = Order::where('invoiceID', $order_transaction_id)->first();


                $order->payment_status = 'paid';
                $order->status = 'Confirmed';
                $order->payment_method = 'bkash';
                if($order->repayment == 1){

                    $payAmount = $order->total - $order->paidAmount;
                    $total_paid = $payAmount + $order->paidAmount;
                    $order->paidAmount =  $total_paid;
                }
                $order->save();
                $cart = Cart::where('user_id', $user_id)->first();

                if(isset($cart)){
                    $cart->delete();
                }

                // Handle session coupon
                if ($couponcode) {
                    Session::forget('couponcode');
                }
                if ($availablecoupon) {
                    Session::forget('availablecoupon');
                }
                Notification::create([
                    'user_id' => $user_id,
                    'title' => 'Order Successfull',
                    'type' => 'order',
                    'invoice'=>$order->invoiceID,
                ]);
                sendNotification('Success', 'New Order Arrived');
                return ApiResponse::success('Order Place Successfully');

            // } else {
            //     return ApiResponse::error('Payment failed. Please try again.');

            // }
        } catch (\Exception $e) {

            return ApiResponse::error($e->getMessage());

        }
    }
}
