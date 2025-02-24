<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User\Notification;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function logout(Request $request)
    {

        auth()->user()->tokens()->delete();

        $user = auth()->user();
        $user->app_token = '';
        $user->save();

        return ApiResponse::onlyMessage('Logout Successfully');
    }

    public function dashboard()
    {
        // Get the start and end dates for the last 7 days
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Get the daily orders within the date range
        $dailyOrders = Order::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count'),
        ])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date')
            ->toArray();

        // Generate date range array
        $dates = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dateString = $date->toDateString();
            $dates[] = [
                'date' => $dateString,
                'count' => (int) ($dailyOrders[$dateString]['count'] ?? 0),
            ];
        }

        $total_order_price = Order::get()->pluck('total')->sum();
        $total_pending_order = Order::where('status', 'Pending')->count();
        $total_active_order = Order::whereIn('status', ['Confirmed', 'Ongoing', 'Pending'])->count();
        $today_total_sale = (int) Order::whereDate('created_at',Carbon::now())->sum('total');

        $datas = [
            'total_order_price' => $total_order_price,
            'total_pending_order' => $total_pending_order,
            'total_active_order' => $total_active_order,
            'today_total_sale'=>$today_total_sale,
            'dailyOrders' => $dates,
        ];

        return ApiResponse::list('Weekly Total order', $datas);
    }

    function allCount(){
        $total_cart = Cart::where('user_id',auth()->user()->id)->count();
        $total_active_order = Order::where('user_id',auth()->user()->id)->whereIn('status', ['Confirmed', 'Ongoing', 'Pending'])->count();
        $total_notification = Notification::where('user_id',auth()->user()->id)->count();
        $total_wishlist = Wishlist::where('user_id',auth()->user()->id)->count();

        $data=[
            'total_active_order'=>$total_active_order,
            'total_notification'=>$total_notification,
            'total_cart'=>$total_cart,
            'total_wishlist'=>$total_wishlist,
        ];
        return ApiResponse::list('Count', $data);
    }
}
