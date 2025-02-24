<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleSummaryController extends Controller
{
    public function list()
    {

        $total_order_price = intval(Order::whereIn('status', ['Completed', 'Shipped', 'Ready to Ship'])->sum('total'));
        $order_count = Order::whereIn('status', ['Completed', 'Shipped', 'Ready to Ship'])->count();
        $pending_order_count = Order::where('status', 'Pending')->count();
        $monthly_sales = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Map through the results to format the sales and create the year-month string
        $monthly_sales = $monthly_sales->map(function ($sale) {
            // Convert total_sales to an integer
            $sale->year = (string)$sale->year;
            $sale->month = (string)$sale->month;
            $sale->total_sales = intval($sale->total_sales);

            return $sale;
        });

        $data = [
            'total_order_price' => $total_order_price,
            'total_order' => $order_count,
            'total_pending_order' => $pending_order_count,
            'monthly_sales' => $monthly_sales,
        ];
        return ApiResponse::list('Sales Summary', $data);
    }

    public function yearlySell(Request $request)
    {
        $year = $request->year;

        $total_order_count = Order::where('status', 'Delivered')->get()->count();
        $total_order_amount = Order::where('status', 'Delivered')->get()->pluck('total')->sum();

        $january = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 1)->get()->sum('total')) > 0) {
            $january = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 1)->get()->count());
        }
        $february = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 2)->get()->sum('total')) > 0) {
            (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 2)->get()->count());
        }
        $march = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 3)->get()->sum('total')) > 0) {
            $march = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 3)->get()->count());
        }
        $April = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 4)->get()->sum('total')) > 0) {
            $April = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 4)->get()->count());
        }
        $May = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 5)->get()->sum('total')) > 0) {
            $May = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 5)->get()->count());
        }
        $June = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 6)->get()->sum('total')) > 0) {
            $June = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 6)->get()->count());
        }
        $July = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 7)->get()->sum('total')) > 0) {
            $July = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 7)->get()->count());
        }
        $August = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 8)->get()->sum('total')) > 0) {
            $August = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 8)->get()->count());
        }
        $September = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 9)->get()->sum('total')) > 0) {
            $September = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 9)->get()->count());
        }
        $October = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 10)->get()->sum('total')) > 0) {
            $October = (Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 10)->get()->count());
        }
        $November = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 11)->get()->sum('total')) > 0) {
            $November = Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 11)->get()->count();
        }
        $December = 0;
        if ((Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 12)->get()->sum('total')) > 0) {
            $December = Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 12)->get()->count();
        }

        $yearly_sall = [
            [
                'year' => $year,
                'month' => 'January',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 1)->get()->sum('total'),
                'total_count' => $january,
            ], [
                'year' => $year,
                'month' => 'February',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 2)->get()->sum('total'),
                'total_count' => $february,
            ], [
                'year' => $year,
                'month' => 'March',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 3)->get()->sum('total'),
                'total_count' => $march,
            ], [
                'year' => $year,
                'month' => 'April',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 4)->get()->sum('total'),
                'total_count' => $April,
            ], [
                'year' => $year,
                'month' => 'May',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 5)->get()->sum('total'),
                'total_count' => $May,
            ], [
                'year' => $year,
                'month' => 'June',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 6)->get()->sum('total'),
                'total_count' => $June,
            ], [
                'year' => $year,
                'month' => 'July',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 7)->get()->sum('total'),
                'total_count' => $July,
            ], [
                'year' => $year,
                'month' => 'August',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 8)->get()->sum('total'),
                'total_count' => $August,
            ], [
                'year' => $year,
                'month' => 'September',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 9)->get()->sum('total'),
                'total_count' => $September,
            ], [
                'year' => $year,
                'month' => 'October',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 10)->get()->sum('total'),
                'total_count' => $October,
            ], [
                'year' => $year,
                'month' => 'November',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 11)->get()->sum('total'),
                'total_count' => $November,
            ], [
                'year' => $year,
                'month' => 'December',
                'total_amount' => Order::whereIn('status', ['Delivered'])->whereYear('orderDate', $year)->whereMonth('orderDate', 12)->get()->sum('total'),
                'total_count' => $December,
            ],
        ];

        $data = [
            'total_order_count' => $total_order_count,
            'total_order_amount' => $total_order_amount,
            'yearly_sall' => $yearly_sall,
        ];

        return ApiResponse::salesbyyear('Sales data by year', $data);
    }
}
