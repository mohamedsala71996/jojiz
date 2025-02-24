<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm(){

        return view('admin.auth.login');

    }
    public function login(Request $request){
        $validated = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ])->validate();

        if (auth()->guard('admin')->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // Admin is logged in
            return redirect()->intended(route('admin.dashboard'));
        }else{
            return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);

        }
    }
}
