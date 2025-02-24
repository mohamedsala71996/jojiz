<?php

namespace App\Http\Controllers\Api;

use App\Models\User\Notification;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class NotificationController extends Controller
{
    public function userNotification()
    {
        $notification = Notification::where('user_id',auth()->user()->id)->latest('id')->get();
        return ApiResponse::list('Notification',$notification);
    }


}
