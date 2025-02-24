<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlertApp;
use Illuminate\Http\Request;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class AlertAppController extends Controller
{
    function alertApp(){
        $alert = AlertApp::first();
        return ApiResponse::list('App Alert', $alert);
    }

    function alertUpdate(Request $request){

        $alert = AlertApp::first();
        $alert->update([
            'title' => $request['title'],
            'discount' => $request['discount'],
            'type' => $request['type'],
            'image' => $request['image'],
            'expire_time' => $request['expire_time'],
            'external_link' => $request['external_link'],
            'internal_link' => $request['internal_link'],
            'active' => $request['active'],
        ]);

        return ApiResponse::successMessage('App Alert', $alert);
    }
}
