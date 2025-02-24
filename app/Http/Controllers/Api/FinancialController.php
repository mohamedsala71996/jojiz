<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\Orderproduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function list(Request $request)
    {
        // Validate the input
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        // Get the start and end dates for the given month
        $month = Carbon::createFromFormat('Y-m', $request->month);
        $startDate = $month->startOfMonth()->format('Y-m-d'); // Start of the month
        $endDate = $month->endOfMonth()->format('Y-m-d'); // End of the month

        // Calculate the start and end of weeks within the month
        $currentWeekStart = Carbon::parse($startDate)->startOfWeek();
        $currentWeekEnd = $currentWeekStart->copy()->endOfWeek();

        // Collect weekly sales data
        $weeklySales = [];

        while ($currentWeekStart->format('Y-m-d') <= $endDate) {
            // Adjust week end date if it goes beyond the month
            if ($currentWeekEnd->format('Y-m-d') > $endDate) {
                $currentWeekEnd = Carbon::parse($endDate);
            }

            $yearWeek = $currentWeekStart->format('oW');
            $sales = Order::whereBetween('created_at', [$currentWeekStart->format('Y-m-d'), $currentWeekEnd->format('Y-m-d')])
                ->sum('total'); // Use 'total' field

            // Store weekly data
            $weeklySales[] = [
                'week' => $yearWeek,
                'start_date' => $currentWeekStart->format('Y-m-d'),
                'end_date' => $currentWeekEnd->format('Y-m-d'),
                'total_sales' => intval($sales),
            ];

            // Move to the next week
            $currentWeekStart->addWeek();
            $currentWeekEnd = $currentWeekStart->copy()->endOfWeek();
        }

        $total_earning = Order::pluck('total')->sum();

        $data = [
            'total_earning' => $total_earning,
            'weekly_sales' => $weeklySales,
        ];

        // Format the response
        return ApiResponse::list('Financial Status', $data);
    }

    public function orderbycategory()
    {
        $categories = Category::where('status', 1)->get();
        $orderproducts = Orderproduct::all();
        $totalqty = Orderproduct::get()->sum('qty');
        if ($orderproducts->isEmpty()) {
            return ApiResponse::orderpercentbycategory('No order products found');
        }

        $categorytext = [];
        foreach ($categories as $category) {
            $cpids = Product::where('category_id', $category->id)->get()->pluck('id');
            $qtysum = Orderproduct::whereIn('product_id', $cpids)->sum('qty');
            $categorytext[] = [
                'id' => $category->id,
                'category_name' => $category->category_name,
                'percent' => ($qtysum / $totalqty) * 100,
            ];
        }
        return ApiResponse::orderpercentbycategory('Order Percent By Category', $categorytext);
    }

    public function salesdata(Request $request)
    {
        $year = $request->year;

        $january = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 1)->get()->sum('total')) > 0){
            $january = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 1)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $february = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 2)->get()->sum('total')) > 0){
            (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 2)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $march = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 3)->get()->sum('total')) > 0){
            $march = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 3)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $April = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 4)->get()->sum('total')) > 0){
            $April = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 4)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $May = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 5)->get()->sum('total')) > 0){
            $May = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 5)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $June = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 6)->get()->sum('total')) > 0){
            $June = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 6)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $July = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 7)->get()->sum('total')) > 0){
            $July = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 7)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $August = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 8)->get()->sum('total')) > 0){
            $August = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 8)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $September = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 9)->get()->sum('total')) > 0){
            $September = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 9)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $October = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 10)->get()->sum('total')) > 0){
            $October = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 10)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $November = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 11)->get()->sum('total')) > 0){
            $November = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 11)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;
        }
        $December = 0;
        if((Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 12)->get()->sum('total')) > 0)
        $December = (Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 12)->get()->sum('total') / Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->get()->sum('total')) * 100;

        $data = [
            [
                'year' => $year,
                'month' => 'January',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 1)->get()->sum('total'),
                'percent' => $january,
            ], [
                'year' => $year,
                'month' => 'February',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 2)->get()->sum('total'),
                'percent' =>$february,
            ], [
                'year' => $year,
                'month' => 'March',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 3)->get()->sum('total'),
                'percent' =>$march ,
            ], [
                'year' => $year,
                'month' => 'April',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 4)->get()->sum('total'),
                'percent' => $April,
            ], [
                'year' => $year,
                'month' => 'May',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 5)->get()->sum('total'),
                'percent' => $May,
            ], [
                'year' => $year,
                'month' => 'June',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 6)->get()->sum('total'),
                'percent' => $June,
            ], [
                'year' => $year,
                'month' => 'July',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 7)->get()->sum('total'),
                'percent' =>  $July ,
            ], [
                'year' => $year,
                'month' => 'August',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 8)->get()->sum('total'),
                'percent' => $August,
            ], [
                'year' => $year,
                'month' => 'September',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 9)->get()->sum('total'),
                'percent' => $September,
            ], [
                'year' => $year,
                'month' => 'October',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 10)->get()->sum('total'),
                'percent' =>  $October,
            ], [
                'year' => $year,
                'month' => 'November',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 11)->get()->sum('total'),
                'percent' => $November,
            ], [
                'year' => $year,
                'month' => 'December',
                'amount' => Order::whereIn('status', ['Confirmed', 'Ongoing', 'Delivered', 'Returned'])->whereYear('orderDate', $year)->whereMonth('orderDate', 12)->get()->sum('total'),
                'percent' => $December,
            ],
        ];

        return ApiResponse::salesbyyear('Sales data by year', $data);
    }

}
