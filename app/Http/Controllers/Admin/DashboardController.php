<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\Orderproduct;
use App\Models\User;
use App\Models\User\QA;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $topSellingProducts = [];
        $categories         = Category::all();

        foreach ($categories as $category) {
            $topcategories[] = [
                "id"       => $category['id'],
                "image"    => $category['image'],
                "name"     => $category['category_name'],
                "slug"     => $category['slug'],
                "products" => Product::where('category_id', $category->id)->get()->count(),
            ];
        }
        $topcategory = collect($topcategories)->sortBy('products')->reverse()->take(6)->toArray();

        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate   = Carbon::now()->endOfDay();

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
            $dates[]    = [
                'date'  => $dateString,
                'count' => (int) ($dailyOrders[$dateString]['count'] ?? 0),
            ];
        }

        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate   = Carbon::now()->endOfDay();

        $dailySellingAmounts = Orderproduct::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(price * qty) as amount'),
        ])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date')
            ->toArray();
        $previousSavenDaysAmount = [];
        for ($i = 0; $i <= 6; $i++) {
            $date                      = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $previousSavenDaysAmount[] = [
                'date'   => $date,
                'amount' => $dailySellingAmounts[$date]['amount'] ?? 0,
            ];
        }
        $user = auth()->user();
        return view('admin.pages.dashboard', compact(
            'topSellingProducts',
            'topcategory',
            'dates',
            'user',
            'previousSavenDaysAmount'
        ));
    }

    public function qna()
    {
        return view('admin.pages.qna.qna');
    }

    public function qnaedit($id)
    {
        $qna = QA::where('id', $id)->first();
        return response()->json($qna);
    }

    public function qnaupdate(Request $request, $id)
    {
        $qna         = QA::where('id', $id)->first();
        $qna->answer = $request->replay;
        $qna->update();
        return response()->json($qna);
    }

    public function qnadata()
    {
        $qnas = QA::whereIn('type', ['question', 're-question'])->where('from', 'user')->get();

        return Datatables::of($qnas)
            ->addColumn('date', function ($qnas) {
                return $qnas->created_at->diffForHumans();
            })
            ->addColumn('user', function ($qnas) {
                if ($qnas->user_id) {
                    return User::where('id', $qnas->user_id)->first()->name . '<br><button class="btn btn-primary btn-sm" style="padding: 0px 4px !important;">' . $qnas->type . '</button>';
                } else {
                    return '';
                }
            })
            ->addColumn('mquestion', function ($qnas) {
                if ($qnas->type == 'question') {
                    return $qnas->question;
                } else {
                    return '';
                }
            })
            ->addColumn('subquestion', function ($qnas) {
                if ($qnas->type == 'question') {
                } else {
                    return $qnas->question;
                }
            })
            ->addColumn('action', function ($qnas) {
                if ($qnas->answer) {
                    return '<span type="button" class="label gradient-11 rounded" id="editqnaBtn" data-id="' . $qnas->id . '" data-bs-toggle="modal" data-bs-target="#editqna"> <i class="fa-solid fa-pen-to-square" ></i></span>';
                } else {
                    return '<span type="button" class="label gradient-11 rounded" id="editqnaBtn" data-id="' . $qnas->id . '" data-bs-toggle="modal" data-bs-target="#editqna"> Replay</span>';
                }
            })
            ->escapeColumns([])->make(true);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
