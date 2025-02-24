<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\Size;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function adminOrderList(Request $request)
    {

        $status = $request->status;
        if ($status == 'All') {
            $orders = Order::with('orderproducts.productvariation', 'couriers', 'products','user')->latest('id')->paginate(5);
            return ApiResponse::list('Product List', $orders);
        } elseif ($status) {
            $orders = Order::where('status', $request->status)->with('orderproducts.productvariation', 'couriers', 'products','user')->latest('id')->paginate(5);
            return ApiResponse::list('Product List', $orders);
        }
        $orders = Order::with('orderproducts.productvariation', 'couriers', 'products','user')->latest('id')->paginate(5);
        return ApiResponse::list('Product List', $orders);
    }
    public function userOrderList(Request $request)
    {

        $status = $request->status;
        if ($status == "Active") {
            $orders = Order::whereIn('status', ['Pending', 'Confirmed', 'Ongoing'])->with('orderproducts.productvariation', 'couriers','user')->where('user_id', auth()->user()->id)->latest('id')->paginate(5);

            return ApiResponse::list('Product List', $orders);
        } else if ($status) {
            $orders = Order::where('status', $request->status)->with('orderproducts.productvariation', 'couriers','user')->where('user_id', auth()->user()->id)->latest('id')->paginate(5);

            return ApiResponse::list('Product List', $orders);
        }
        $orders = Order::with('orderproducts.productvariation', 'couriers','user')->where('user_id', auth()->user()->id)->latest('id')->paginate(5);
        return ApiResponse::list('Product List', $orders);
    }

    public function userOrderCancel(Request $request)
    {
        $order = Order::where('invoiceID', $request->invoiceID)->first();
        $order->status = 'Canceled';
        $order->save();
        return ApiResponse::successMessage('Order Cencel Successfully');
    }

    public function userOrderInvoice()
    {
        $orders = Order::with('user', 'orderproducts','user')->get();
        return ApiResponse::list('Product List', $orders);
    }
    public function adminOrderStatus(Request $request)
    {
        $order = Order::where('invoiceID', $request->invoiceID)->first();
        $order->status = $request->status;
        $order->save();
        return ApiResponse::list('Product List', $order);
    }

    public function stock()
    {
        $productStock = Size::pluck('total_stock')->sum();
        $recently_added = Product::where('created_at', '>=', now()->subDays(7))->count();
        $sold = Size::pluck('sold')->sum();
        $data = [
            'total_product_stock' => $productStock,
            'recently_added_product' => $recently_added,
            'sold' => $sold,
        ];

        return ApiResponse::list('Stock Summery', $data);
    }

    public function countorder()
    {
        $response['total'] = DB::table('orders')->count();
        $response['pending'] = DB::table('orders')->where('status', 'like', 'Pending')->count();
        $response['confirmed'] = DB::table('orders')->where('status', 'like', 'Confirmed')->count();
        $response['ongoing'] = DB::table('orders')->where('status', 'like', 'Ongoing')->count();
        $response['delivered'] = DB::table('orders')->where('status', 'like', 'Delivered')->count();
        $response['canceled'] = DB::table('orders')->where('status', 'like', 'Canceled')->count();
        $response['returned'] = DB::table('orders')->where('status', 'like', 'Returned')->count();
        $response['rejected'] = DB::table('orders')->where('status', 'like', 'Rejected')->count();
        return ApiResponse::countorder('Order count by Status', $response);
    }

    public function findorderbyslug(Request $request)
    {
        $orderByinvoice = Order::with('user', 'orderproducts.productvariation', 'couriers', 'products','user')->where('invoiceID', $request->invoiceID)->paginate();
        if(isset($orderByinvoice) ) {
            return ApiResponse::findorder('Order find by invoice id', $orderByinvoice);
        }
        return ApiResponse::error('Order Not Found', $orderByinvoice,false);
    }

}
