<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\Orderproduct;
use App\Models\Review;
use App\Models\User\QA;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function index()
    {

        // $order_products = Orderproduct::latest('id')->get();
        $orders = Order::where('user_id',auth()->user()->id)->with('orderproducts')->latest('id')->get();
        

        return view('user.dashboard', compact('orders'));
    }

    public function manageorder($slug)
    {
        $order = Order::with('orderproducts')->where('invoiceID', $slug)->first();
        return view('user.pages.manageorder', compact('order'));
    }

    public function leavereview($slug)
    {
        $id = Crypt::decrypt($slug);
        $product = Product::with('productvariations')->findOrfail($id);
        $review = Review::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
        return view('user.pages.myreview', compact('product', 'review'));
    }

    public function askquestion(Request $request)
    {

        $qa = new QA();
        $qa->user_id = $request->user_id;
        $qa->admin_id = 1;
        $qa->product_id = $request->product_id;
        $qa->type = 'question';
        $qa->from = 'user';
        $qa->question = $request->question;
        $qa->save();
        Toastr::success(__("frontend.Question submit successfully"));
        return response()->json('success');
    }

    public function replayquestion(Request $request)
    {
        $qa = new QA();
        $qa->user_id = $request->user_id;
        $qa->qna_id = $request->qa;
        $qa->admin_id = 1;
        $qa->product_id = $request->product_id;
        $qa->type = 're-question';
        $qa->from = 'user';
        $qa->question = $request->question;
        $qa->save();
        Toastr::success(__("frontend.Re-Question submit successfully"));
        return response()->json('success');
    }

    public function loadquestion(Request $request)
    {
        $qna = QA::where('product_id', $request->product_id)->where('type', 'question')->get();
        return view('frontend.include.qna', ['qna' => $qna]);
    }

    public function storereview(Request $request)
    {
        if (isset($request->review_id)) {
            $review = Review::where('id', $request->review_id)->first();
        } else {
            $review = new Review();
        }
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->user_id = $request->user_id;
        $review->text = $request->messages;

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imgfiles) {
                $name = time() . "_" . $imgfiles->getClientOriginalName();
                $imgfiles->move(public_path() . '/images/review/', $name);
                $imageData[] = $name;
            }
            $review->image = json_encode($imageData);
        };

        $review->save();
        Toastr::success(__('frontend.Review Place Successfully'));
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
