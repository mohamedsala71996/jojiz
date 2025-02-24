<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\User\Notification;
use App\Notifications\InvoiceMail;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

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
        $order = session()->get('order');


            $order->status = 'Confirmed';
            $order->payment_status = 'paid';
            $order->save();
            session()->forget('order');

        Notification::create([
            'user_id' => auth()->user()->id,
            'title' => __('frontend.Order Successfull'),
            'type'=>'order',
            'invoice'=>$order->invoiceID
        ]);
        $superadmin = Admin::first();
        $superadmin->notify(new InvoiceMail($order));
         //For push notification
         sendNotification('Success','New Order Arrived');
        Cart::where('user_id', auth()->user()->id)->delete();
        session()->forget('order');
        Session::forget('couponcode');
        Session::forget('availablecoupon');
        Toastr::success(__("frontend.Order Place Successfully"));
        return redirect('user/my-order');

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
            $order = session()->get('order');

            $order->status = 'Cancelled';
            $order->save();
            session()->forget('order');
            Toastr::success(__("frontend.Order Cancelled"));
             //For push notification
             sendNotification('Success','New Order Cancelled');
            return redirect()->route('index');
        }
    }
}
