<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

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
            return ApiResponse::error('azorpay credentials not found');
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
                    if($order->repayment == 1){
                        $payAmount = $order->total - $order->paidAmount;
                        $total_paid = $payAmount + $order->paidAmount;
                        $order->paidAmount =  $total_paid;
                    }
                    $order->save();

                    Notification::create([
                        'user_id' => $userId,
                        'title' => 'Order Successfull',
                        'type'=>'order',
                        'invoice'=>$order->invoiceID,
                    ]);
                    //For push notification
                    sendNotification('Success', 'New Order Arrived');
                    $cart = Cart::where('user_id', $userId)->first();
                    if(isset($cart)){
                        $cart->delete();
                    }
                    session()->forget('order');
                    Session::forget('couponcode');
                    Session::forget('availablecoupon');
                    return ApiResponse::success('Order Place Successfully');
                } else {
                    return ApiResponse::error('Notes not found in payment details');
                }

            } catch (\Exception $e) {
                return ApiResponse::error('Failed to fetch payment details: ' . $e->getMessage());
            }
        } elseif ($razorpayOrderId && !$razorpayPaymentId) {
            // Payment failed or was canceled

            // Log the failure or cancellation for debugging
            Log::info("Payment failed or canceled for order ID: {$razorpayOrderId}");

            // Handle the failed payment, e.g., show a failure message to the user

            return ApiResponse::error('Payment failed or canceled');
        }

    }
}
