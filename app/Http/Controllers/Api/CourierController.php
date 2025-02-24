<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coupon;
use App\Models\Courier;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class CourierController extends Controller
{
    public function list(){
        $couriers =Courier::get();
        return ApiResponse::list('Courier List', $couriers);
    }
}
