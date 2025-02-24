<?php

namespace App\Http\Helpers\Api;

class Helpers
{
    public static function loginSuccess($status = null, $message = null, $data = null)
    {
        return response()->json(['status' => $status, 'message' => [$message], 'data' => $data], 200);
    }
    public static function loginError($message = 'Something Went Wrong', $data = null,$status=false)
    {
        return response()->json(['status'=>$status,'message' => [$message], 'data' => $data], 200);
    }
    public static function success($message = null, $data = null)
    {
        return response()->json(['title' => $message, 'data' => $data], 200);
    }
    public static function successMessage($message = null, $data = null,$status=true)
    {
        return response()->json(['status'=>$status,'message' => $message, 'data' => $data], 200);
    }
    public static function errorMessage($message = 'Something Went Wrong', $data = null,$status=false)
    {
        return response()->json(['status'=>$status,'message' => $message, 'data' => $data], 200);
    }
    public static function list($title = null, $data = null)
    {
        return response()->json(['title' => $title, 'data' => $data], 200);
    }
    public static function unauthorized($message = 'Something Went Wrong', $data = null)
    {
        return response()->json(['status' => false, 'message' => $message, 'data' => $data], 401);
    }
    public static function validation($message = 'Invalid Submission', $data = null)
    {
        return response()->json(['status' => false, 'message' => $message, 'data' => $data], 200);
    }
    public static function created($message = 'Data Created', $data = null,$status=true)
    {
        return response()->json(['status'=>$status,'message' => $message, 'data' => $data], 200);

    }


    public static function error($message = 'Something Went Wrong', $data = null,$status=false)
    {
        return response()->json(['status'=>$status,'message' => $message, 'data' => $data], 200);

    }
    public static function onlyMessage($message = 'Something Went Wrong')
    {
        return response()->json(['message' => $message], 200);
    }

    public static function countorder($title = null, $data = null)
    {
        return response()->json(['status' => true, 'message' => $title, 'data' => $data], 200);
    }

    public static function findorder($title = null, $data = null)
    {
        return response()->json(['status' => true, 'message' => $title, 'data' => $data], 200);
    }

    public static function orderpercentbycategory($title = null, $data = null)
    {
        return response()->json(['status' => true, 'message' => $title, 'data' => $data], 200);
    }
    public static function salesbyyear($title = null, $data = null)
    {
        return response()->json(['status' => true, 'message' => $title, 'data' => $data], 200);
    }
    public static function onlyError($message = 'Something Went Wrong')
    {
        return response()->json(['message' => $message], 400);
    }
}
