<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class SliderController extends Controller
{
    public function list(){
        $sliders = Slider::get();
        return ApiResponse::list('All Slider',$sliders);
    }
}
