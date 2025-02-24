<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\OtherDeliveryCharge;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class OtherDeliveryChargeController extends Controller
{
    function edit(){
        $webinfo = GeneralSetting::first();
        $other_delivery_charge = OtherDeliveryCharge::first();
        return view('admin.pages.other-delivery-charge.edit',compact('other_delivery_charge','webinfo'));
    }
    function update(Request $request){
        $validated = Validator::make($request->all(), [
            'normal_delivery_fee'=>'required',
            'normal_delivery_duration'=>'required',
            'normal_delivery_status'=>'required',
            'express_delivery_fee'=>'required',
            'express_delivery_duration'=>'required',
            'express_delivery_status'=>'required',
            'pick_up_our_place_fee'=>'required',
            'pick_up_our_place_duration'=>'required',
            'pick_up_our_place_status'=>'required',
            'free_shipping_fee'=>'required',
            'free_shipping_status'=>'required',
        ])->validate();
        try{
            $other_delivery_charge = OtherDeliveryCharge::first();
            $other_delivery_charge->update($validated);
        }catch(Exception $e){
            Toastr::error('Something Went Wrong, Please Try Again');
            return back();
        }
        Toastr::success(__('backend.Other Delivery Charge Updated Successfully'));
        return back();

    }
}
