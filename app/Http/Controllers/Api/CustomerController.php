<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\User;

class CustomerController extends Controller
{
    function list(){
        $users = User::get();
        return ApiResponse::list('All Users',$users);
    }
}
