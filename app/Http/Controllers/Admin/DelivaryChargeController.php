<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DelivaryCharge;
use App\Models\ExpenseCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DelivaryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryCharges = DelivaryCharge::get();
        return view('admin.pages.delivery-charge.index', compact('deliveryCharges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'city' => 'required',
            'amount' => 'required',
        ])->validate();
        try {
            DelivaryCharge::create($validated);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
        }
        Toastr::success(__('frontend.Delivery Charge Added Successfully!'));
        return redirect()->route('admin.delivery-charges.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $delivaryCharge = DelivaryCharge::findOrfail($id);
        return response()->json($delivaryCharge);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(), [
            'city' => 'required',
            'amount' => 'required',
        ])->validate();
        $delivaryCharge = DelivaryCharge::findOrFail($id);
        try {

            $delivaryCharge->update($validated);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
        }
        return response()->json(['status' => 'success', 'message' => __('frontend.Delivery Charge Added Successfully!')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delivaryCharge = DelivaryCharge::findOrfail($id);
        $delivaryCharge->delete();
        return response()->json(['status' => 'success', 'message' => __('backend.Delivery Charge Delete Successfully!')]);
    }
}
