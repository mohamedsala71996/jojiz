<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\Notification;
use App\Http\Helpers\Api\Helpers as ApiResponse;


class SslcommerzController extends Controller
{
    public function success(Request $request)
    {

        // Handle success
        $data = $request->all();
        $tran_id = $data['tran_id'];


        // Verify the transaction

        if ($data['status'] == 'VALID') {

        $order = Order::where('invoiceID',$tran_id)->first();

        $order->status = 'Confirmed';
        $order->payment_status = 'paid';
        if($order->repayment == 1){

            $payAmount = $order->total - $order->paidAmount;
            $total_paid = $payAmount + $order->paidAmount;
            $order->paidAmount =  $total_paid;
        }
        $order->save();
            // Update order status
            // return view('payment.success', compact('data'));
            Notification::create([
                'user_id' => $order->user_id,
                'title' => 'Order Successfull',
                'type'=>'order',
                'invoice'=>$order->invoiceID,
            ]);
            sendNotification('Success', 'New Order Arrived');
            return ApiResponse::onlyMessage('Order Successfully');

        } else {
            // return redirect('/')->with('error', 'Payment validation failed.');
            return ApiResponse::onlyMessage('Payment validation failed.');
        }
    }

    public function fail(Request $request)
    {
        // Handle fail
        $data = $request->all();
        return ApiResponse::onlyMessage('Order Failed');
        // return view('payment.fail', compact('data'));
    }

    public function cancel(Request $request)
    {
        // Handle cancel
        $data = $request->all();
        return ApiResponse::onlyMessage('Order Cancel');
        // return view('payment.cancel', compact('data'));
    }


}
