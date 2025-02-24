<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\User\Notification;
use App\Notifications\InvoiceMail;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class SslCommerzPaymentController extends Controller
{
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {

            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update([
                    'status' => 'Confirmed',
                    'payment_status' => 'paid',
                ]);
            //For push notification
            sendNotification('Success', 'New Order arrived');
            Toastr::success(__("frontend.Order Place Successfully"));
            $user_id = Order::where('invoiceID', $tran_id)->first()->user_id;
            if ($user_id) {
                Auth::loginUsingId($user_id);
                return redirect()->route('user.dashboard');

            } else {
                Toastr::success(__("frontend.Order Place Successfully"));

                return redirect()->route('index');
            }

        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            //For push notification
            $user_id = Order::where('invoiceID', $tran_id)->first()->user_id;
            Notification::create([
                'user_id' => $user_id,
                'title' => 'Order Successfull',
                'type' => 'order',
                'invoice'=>$tran_id,
            ]);
            $order = Order::where('invoiceID', $tran_id)->first();
            $superadmin = Admin::first();
            $superadmin->notify(new InvoiceMail($order));
            sendNotification('Success', 'New Order arrived');
            echo 'processing';
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }

    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            Toastr::error(__("frontend.Transaction is Falied"));
            //For push notification
            sendNotification('Success', 'New Order Failed');
            $user_id = Order::where('invoiceID', $tran_id)->first()->user_id;
            if ($user_id) {
                Auth::loginUsingId($user_id);
                return redirect()->route('user.dashboard');
            } else {
                Toastr::success(__("frontend.Order Place Successfully"));
                return redirect()->route('index');
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            Toastr::error('Transaction is Cancel');
            //For push notification
            sendNotification('Success', 'New Order Canceled');
            $user_id = Order::where('invoiceID', $tran_id)->first()->user_id;
            if ($user_id) {
                Auth::loginUsingId($user_id);
                return redirect()->route('user.dashboard');
            } else {
                Toastr::success(__("frontend.Order Place Successfully"));
                return redirect()->route('index');
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

}
