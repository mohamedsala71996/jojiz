<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Currency;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;


class CurrencyController extends Controller
{
    public function list(){
        $currency = Currency::first();
        return ApiResponse::list('Currency Details', $currency);
    }
}
