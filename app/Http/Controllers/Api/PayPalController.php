<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User\Notification;
use App\Notifications\InvoiceMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class PayPalController extends Controller
{
    public function handleSuccess(Request $request)
    {

        $paypal = new PayPalClient();

        // Retrieve PayPal credentials from the database
        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'paypal')
            ->first()->credentials;

        $paymentCredentials = json_decode($paymentCredentials);

        $paypal->setApiCredentials([
            'mode' => $paymentCredentials->is_localhost == 'live' ? 'live' : 'sandbox',
            $paymentCredentials->is_localhost => [
                'client_id' => $paymentCredentials->client_id,
                'client_secret' => $paymentCredentials->secret,
            ],
            'payment_action' => 'sale',
            'currency' => 'USD',
            'notify_url' => 'your_notify_url', // Your IPN notification URL
            'locale' => 'en_US',
            'validate_ssl' => true,
        ]);

        $paypal->getAccessToken();

        // Capture the order
        $response = $paypal->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {

            $invoiceID = $request->invoiceID; // You can pass it in the query string if required
            $order = Order::where('invoiceID', $invoiceID)->first();

            $order->status = 'Confirmed';
            $order->payment_status = 'paid';
            $order->save();

            Notification::create([
                'user_id' => $order->user_id,
                'title' => __('frontend.Order Successfull'),
                'type' => 'order',
                'invoice' => $order->invoiceID,
            ]);
            $superadmin = Admin::first();
            $superadmin->notify(new InvoiceMail($order));
            //For push notification
            sendNotification('Success', 'New Order Arrived');
            Cart::where('user_id', $order->user_id)->delete();
            session()->forget('order');
            Session::forget('couponcode');
            Session::forget('availablecoupon');
            return ApiResponse::created('Order Create Successfully');
        }
        return ApiResponse::created('Order Cancelled');
    }
    public function handleCancel(Request $request)
    {
       
        // Optionally retrieve the token or custom data if needed
        $invoiceID = $request->invoiceID; // You can pass it in the query string if required

        // Update the order status to canceled in the database
        $order = Order::where('invoiceID', $invoiceID)->first();

        $order->status = 'Cancelled';
        $order->save();

        Cart::where('user_id', $order->user_id)->delete();
        Session::forget('couponcode');
        Session::forget('availablecoupon');

        //For push notification
        sendNotification('Success', 'New Order Cancelled');
        return ApiResponse::created('Order Cancelled');
    }

}
