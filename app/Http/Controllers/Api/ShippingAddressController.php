<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingAddressController extends Controller
{
    public function list()
    {
        $shipping_addresss = ShippingAddress::where('user_id',auth()->user()->id)->get();
        return ApiResponse::created('Shipping Address',$shipping_addresss);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'selected_area' => 'required|string',
            'address' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'delivery_charge' => 'required|string',
            'label' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return ApiResponse::validation($validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated['user_id']= auth()->user()->id;
        $shippingAddress = ShippingAddress::create($validated);
        return ApiResponse::created('Shipping Address Successfully', $shippingAddress);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'selected_area' => 'required|string',
            'address' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'delivery_charge' => 'required|string',
            'label' => 'nullable|string',

        ]);
        if ($validator->fails()) {
            return ApiResponse::validation($validator->errors()->all());
        }
        $validated = $validator->validate();
        $shipping_address = ShippingAddress::find($request->shipping_address_id);
        $validated['user_id']= auth()->user()->id;
        $shipping_address = $shipping_address->update($validated);
        return ApiResponse::created('Shipping Address Updated Successfully', $shipping_address);
    }
    public function destroy(Request $request)
    {
        $shipping_address = ShippingAddress::find($request->shipping_address_id);
        $shipping_address = $shipping_address->delete();
        return ApiResponse::onlyMessage('Shipping Address Deleted Successfully');
    }

}
