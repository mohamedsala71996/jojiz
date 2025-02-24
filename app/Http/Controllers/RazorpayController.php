<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\User\Notification;
use App\Notifications\InvoiceMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class RazorpayController extends Controller
{


    public function callbackRazorpay(Request $request)
    {
        $razorpayPaymentId = $request->query('razorpay_payment_id');
        $razorpaySignature = $request->query('razorpay_signature');
        $razorpayOrderId = $request->query('razorpay_order_id');

        // Verify the signature here (recommended)

        // Fetch Razorpay credentials from your database
        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'razorpay')
            ->first()->credentials;
        $paymentCredentials = json_decode($paymentCredentials);
        if (!$paymentCredentials) {
            Toastr::error('Razorpay credentials not found');
        }

        // Initialize Razorpay API
        $razorpay = new Api($paymentCredentials->RAZORPAY_ID_KEY, $paymentCredentials->RAZORPAY_SECRET_KEY);
        if ($razorpayPaymentId && $razorpaySignature) {
            try {
                // Fetch the full payment details from Razorpay
                $paymentDetails = $razorpay->payment->fetch($razorpayPaymentId);

                // Retrieve notes (custom metadata)
                $invoiceID = $paymentDetails['notes']['invoiceID'] ?? null;
                $userId = $paymentDetails['notes']['user_id'] ?? null;

                // Perform your logic with orderId and userId
                if ($invoiceID && $userId) {
                    // Handle success - e.g., update order status in your database
                    $order = Order::where('invoiceID', $invoiceID)->first();
                    $order->status = 'Confirmed';
                    $order->payment_status = 'paid';
                    $order->save();

                    Notification::create([
                        'user_id' => $userId,
                        'title' => 'Order Successfull',
                        'type'=>'order',
                        'invoice'=>$invoiceID
                    ]);
                    $superadmin = Admin::first();
                    $superadmin->notify(new InvoiceMail($order));
                    //For push notification
                    sendNotification('Success', 'New Order Arrived');
                    Cart::where('user_id', $userId)->delete();
                    session()->forget('order');
                    Session::forget('couponcode');
                    Session::forget('availablecoupon');
                    Toastr::success(__("frontend.Order Place Successfully"));
                    return redirect('user/my-order');
                } else {
                    Toastr::error('Notes not found in payment details');
                    return redirect('user/my-order');
                }

            } catch (\Exception $e) {
                Toastr::error('Failed to fetch payment details: ' . $e->getMessage());
                return redirect('user/my-order');
            }
        } elseif ($razorpayOrderId && !$razorpayPaymentId) {
            // Payment failed or was canceled

            // Log the failure or cancellation for debugging
            Log::info("Payment failed or canceled for order ID: {$razorpayOrderId}");

            Toastr::error('Payment failed or canceled');
            return redirect('user/my-order');
        }

    }
}
