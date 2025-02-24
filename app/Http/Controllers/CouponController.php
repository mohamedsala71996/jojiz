<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Coupon;
use DataTables;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $coupons = Coupon::latest()->get();
        return view('admin.pages.coupon.index', compact('categories','coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function coupondata()
    // {
    //     $cities = Coupon::all();
    //     return Datatables::of($cities)
    //         ->addColumn('action', function ($cities) {
    //             return '
    //             <a href="#" type="button" id="deleteCouponBtn" data-id="' . $cities->id . '" class="confirmDelete btn btn-danger btn-sm" ><i class="bi bi-archive" ></i></a>';
    //             // return '<a href="#" type="button" id="editCouponBtn" data-id="' . $cities->id . '"   class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editmainCoupon" ><i class="bi bi-pencil-square"></i></a>
    //             // <a href="#" type="button" id="deleteCouponBtn" data-id="' . $cities->id . '" class="btn btn-danger btn-sm" ><i class="bi bi-archive" ></i></a>';
    //         })

    //         ->make(true);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'code' => 'required|unique:coupons,code',
            'validity' => 'required|date',
            'type' => 'required',
            'status' => 'required',
            'amount' => 'required|numeric',
            'coupon_type' => 'required',
            'categories' => 'required|array',
        ]);
        // $coupon = Coupon::create($request->all());
        $coupon = Coupon::create([
            'code' => $request->code,
            'validity' => $request->validity,
            'date' => $request->date,
            'type' => $request->type,
            'amount' => $request->amount,
            'coupon_type' => $request->coupon_type,
            'status' => $request->status,
        ]);

        // Associate categories if it's category-specific
        if ($request->coupon_type === 'category') {
            $coupon->categories()->sync($request->categories);
        }
        return response()->json($coupon, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrfail($id);
        return response()->json($coupon, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $coupon = Coupon::findOrfail($id)->update($request->all());
        return response()->json($coupon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrfail($id);

        $coupon->delete();
        return response()->json([
            'status' => 'success',
            'message' => __("frontend.Coupon Delete Successfully!"),
        ], 200);
    }

    public function updatestatus(Request $request)
    {

        $coupon = Coupon::Where('id', $request->coupon_id)->first();
        $coupon->status = $request->status;
        $coupon->save();

        return response()->json($coupon, 200);
    }
}
