<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Http\Resources\User\UserResource;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'app_token' => 'nullable',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation($validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = true;

        $user = User::create($validated);

        $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;

        $data = [
            'token' => $token,
            'user' => new UserResource($user),
        ];
        return ApiResponse::loginSuccess(true,'Registration successful', $data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'app_token'=>'nullable'
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();

        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            $user->app_token =$validated['app_token'];
            $user->save();
            $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
            $data = [
                'token' => $token,
                'user' => $user,
            ];
            return ApiResponse::loginSuccess(true,'Login Successfully', $data);
        } else {
            return ApiResponse::loginError('The credentials does not match');
        }

    }
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'app_token'=>'nullable'
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();
        $admin = Admin::where('email', $validated['email'])->first();
        if ($admin && Hash::check($validated['password'], $admin->password)) {

            $admin->app_token = $validated['app_token'];
            $admin->save();
            $token = $admin->createToken('Laravel Password Grant Client')->plainTextToken;
            $data = [
                'token' => $token,
                'admin' => $admin,
            ];
            return ApiResponse::loginSuccess(true,'Login Successfully', $data);
        } else {
            return ApiResponse::loginError('The credentials does not match');
        }
    }

}
