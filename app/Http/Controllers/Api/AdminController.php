<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class AdminController extends Controller
{
    function list(){
        $admin = Admin::get();
        return ApiResponse::list('All Admin',$admin);
    }
}
