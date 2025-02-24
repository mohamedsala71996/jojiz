<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\TemporaryData;
use App\Models\User\Notification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;


class StripeController extends Controller
{
    public function stripeSuccess(Request $request)
    {

        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'stripe')
            ->first()->credentials;

        $paymentCredentials = json_decode($paymentCredentials);
        $stripe = new \Stripe\StripeClient($paymentCredentials->secret_key);
        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        if($response->metadata['invoiceID'] != null){
            $invoiceID = $response->metadata['invoiceID'];
            $order = Order::where('invoiceID', $invoiceID)->first();
            $order->payment_status = 'paid';
            $order->payment_method = 'stripe';
            if($order->repayment == 1){

                $payAmount = $order->total - $order->paidAmount;
                $total_paid = $payAmount + $order->paidAmount;
                $order->paidAmount =  $total_paid;
            }

            $order->save();
            Notification::create([
                'user_id' => $response->metadata['user_id'],
                'title' => 'Order Successfull',
                'type'=>'order',
                'invoice'=>$order->invoiceID,
            ]);

            return ApiResponse::created('Order Create Successfully');
        }

        $order_json = json_decode($response->metadata['order']);


        $order = Order::where('invoiceID', $order_json->invoiceID)->first();
        $order->payment_status = 'paid';;
        $order->save();


        TemporaryData::where('user_id', $response->metadata['user_id'])->delete();
        Cart::where('user_id', $response->metadata['user_id'])->delete();
        sendNotification('Success', 'New Order Arrived');
        return ApiResponse::created('Order Create Successfully');
    }
    public function stripeCancel(Request $request)
    {
        if (isset($request->session_id)) {
            $paymentCredentials = DB::table('payment_credentials')
                ->where('gateway', 'stripe')
                ->first()->credentials;
            $paymentCredentials = json_decode($paymentCredentials);

            $stripe = new \Stripe\StripeClient($paymentCredentials->secret_key);
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            $order_json = json_decode($response->metadata['order']);

            $order = Order::where('invoiceID', $order_json->invoiceID)->first();
            $order->status = 'Cancelled';;
            $order->save();

            return ApiResponse::created('Order Cancelled');
        }
    }
}
