<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserPasswordReset;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\PasswordResetEmail;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    // use SendsPasswordResetEmails;

    public function showForgetForm()
    {
        return view('user.auth.forget-password');
    }
    public function passwordSendCode(Request $request)
    {
        $request->validate([
            'email' => "required|email",
        ]);

        $user = User::where('email',$request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => "User doesn't exists.",
            ]);
        }

        $token = generate_unique_string("user_password_resets", "token", 80);
        $code = generate_random_code();

        try {
            UserPasswordReset::where("user_id", $user->id)->delete();
            $password_reset = UserPasswordReset::create([
                'user_id' => $user->id,
                'token' => $token,
                'code' => $code,
            ]);
            $user->notify(new PasswordResetEmail($user, $password_reset));
        } catch (Exception $e) {

            Toastr::error(__("frontend.Something went worng! Please try again."));
            return redirect()->back();

        }
        Toastr::success(__("frontend.Varification code sended to your email address."));
        return redirect()->route('user.otp.verify.form', $token);
    }
    public function showOtpVerifyForm($token)
    {
        $password_reset = UserPasswordReset::where("token", $token)->first();

        $user_email = $password_reset->user->email ?? "";
        return view('user.auth.otp-verify', compact( 'token', 'user_email'));
    }

    public function verifyCode(Request $request, $token)
    {

        $request->merge(['token' => $token]);
        $validated = Validator::make($request->all(), [
            'token'         => "required|string|exists:user_password_resets,token",
            'code'          => "required",

        ])->validate();

        $password_reset = UserPasswordReset::where("token", $token)->first();


        if ($password_reset->code != $validated['code']) {
            throw ValidationException::withMessages([
                'code'      => "Verification Otp is Invalid",
            ]);
        }

        return redirect()->route('user.password.reset.form', $token);
    }
    public function passwordResetForm($token)
    {
        return view('user.auth.reset-password', compact( 'token'));
    }
    public function resetPassword(Request $request, $token)
    {
        $passowrd_rule = "required|string|confirmed";

        $request->merge(['token' => $token]);
        $validated = Validator::make($request->all(), [
            'token'         => "required|string|exists:user_password_resets,token",
            'password'      => $passowrd_rule,
        ])->validate();

        $password_reset = UserPasswordReset::where("token", $token)->first();
        if (!$password_reset) {
            throw ValidationException::withMessages([
                'password'      => "Invalid Request. Please try again.",
            ]);
        }

        try {
            $password_reset->user->update([
                'password'      => Hash::make($validated['password']),
            ]);
            $password_reset->delete();
        } catch (Exception $e) {
            Toastr::error(__("frontend.Something went worng! Please try again."));
            return back();
        }

        Toastr::success(__("frontend.Password reset success. Please login with new password."));
        return redirect()->route('index');
    }

}
