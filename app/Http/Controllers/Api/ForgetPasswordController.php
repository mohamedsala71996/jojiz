<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\User\PasswordResetEmail;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class ForgetPasswordController extends Controller
{
    public function sendOtpCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return ApiResponse::validation($validator->errors()->all());
        }
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return ApiResponse::error("User doesn't exists.");
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
            return ApiResponse::error(['Something went wrong. Please try again.']);
        }
        return ApiResponse::created(['Varification code sended to your email address.'],$password_reset);
    }

    public function verifyOtpCode(Request $request)
    {
        $token = $request->token;
        $request->merge(['token' => $token]);
        $validator = Validator::make($request->all(), [
            'token' => "required|string|exists:user_password_resets,token",
            'code' => "required",

        ]);

        if ($validator->fails()) {

            return ApiResponse::validation($validator->errors()->all());
        }
        $validated = $validator->validate();

        $password_reset = UserPasswordReset::where("token", $token)->first();

        if ($password_reset->code != $validated['code']) {

            return ApiResponse::error("Verification Otp is Invalid");
        }

        return ApiResponse::created('Verification Successfully', $password_reset);
    }
    public function resetPassword(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return ApiResponse::error('Oops password does not match.');
        }
        $token = $request->token;
        $passowrd_rule = "required|string|confirmed";
        $request->merge(['token' => $token]);

        $validated = Validator::make($request->all(), [
            'token'         => "required|string|exists:user_password_resets,token",
            'password'      => $passowrd_rule,
        ])->validate();

        $password_reset = UserPasswordReset::where("token", $token)->first();
        if (!$password_reset) {
            return ApiResponse::error(['Invalid Request. Please try again.']);
        }

        try {
            $password_reset->user->update([
                'password'      => Hash::make($validated['password']),
            ]);
            $password_reset->delete();
        } catch (Exception $e) {
            return ApiResponse::onlyMessage(['Something went wrong. Please try again.']);
        }
        return ApiResponse::created(['Password reset success. Please login with new password.']);
    }
}
