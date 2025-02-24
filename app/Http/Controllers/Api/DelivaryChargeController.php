<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\DelivaryCharge;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\OtherDeliveryCharge;

class DelivaryChargeController extends Controller
{
    public function delivaryCharge()
    {
        $basic_setting = GeneralSetting::first();

        $deliveryCharge = [
            'shippingCharge' => $basic_setting->delivary_charge,
            'delivery_charge_type' => $basic_setting->delivery_charge_type,
        ];
        return ApiResponse::list('Chekout List', $deliveryCharge);
    }
    public function deliveryCity()
    {
        $delivaryCharges = DelivaryCharge::get();
        return ApiResponse::list('Delivery List', $delivaryCharges);
    }
    public function deliveryOption()
    {
        $deliveryOption = OtherDeliveryCharge::first();
        return ApiResponse::list('Delivery Option List', $deliveryOption);
    }

}
