<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User\Notification;
use App\Notifications\InvoiceMail;
use App\Traits\PaymentGateway\Bkash;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BkashTokenizePaymentController extends Controller
{
    use Bkash;

    public function bkashCallBack(Request $request)
    {
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

            if (isset($responseData['transactionStatus']) && $responseData['transactionStatus'] === 'Completed') {

                Cart::where('user_id', auth()->user()->id)->delete();
                $order_id = session('order_id');
                $order = Order::find($order_id);
                $order->payment_status = 'paid';
                $order->status = 'Confirmed';
                $order->payment_method = 'bkash';
                $order->save();
                Session::forget('couponcode');
                Session::forget('availablecoupon');
                Session::forget('order_id');
                //For push notification
                sendNotification('Success', 'New Order Arrived');

                Notification::create([
                    'user_id' => auth()->user()->id,
                    'title' => 'Order Successfull',
                    'type' => 'order',
                    'invoice' => $order->invoiceID,
                ]);
                $superadmin = Admin::first();
                try {
                    $superadmin->notify(new InvoiceMail($order));
                } catch (Exception $e) {
                    dd($e);
                }

                Toastr::success(__("frontend.Order Place Successfully"));
                return redirect()->route('user.my.order');

            } else {
                //For push notification
                sendNotification('Success', 'New Order Failed');
                Toastr::error(__('frontend.Payment failed. Please try again.'));
                return redirect()->route('user.my.order');
            }
        } catch (\Exception $e) {

            Toastr::error($e->getMessage());
            return redirect()->route('user.my.order');
        }
    }
}
