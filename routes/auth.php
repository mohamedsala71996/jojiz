<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Authentication Route
Route::middleware(['admin.login.guard'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    Route::get('login', [LoginController::class, "showLoginForm"])->name('login');
    Route::post('login/submit', [LoginController::class, "login"])->name('login.submit');

});

Route::controller(ForgotPasswordController::class)->group(function(){
    Route::get('password-forget','showForgetForm')->name('user.forget.password');
    Route::post('password-send-code','passwordSendCode')->name('user.forget.send.code');
    Route::get('otp-verify-form/{token}','showOtpVerifyForm')->name('user.otp.verify.form');
    Route::post('otp-verify/{token}','verifyCode')->name('user.otp.verify');
    Route::get('password-reset-form/{token}','passwordResetForm')->name('user.password.reset.form');
    Route::post('password-reset/{token}','resetPassword')->name('user.password.reset');
});

Route::controller(AuthLoginController::class)->prefix('login')->group(function(){
    Route::get('/{provider}','redirectToProvider')->name('user.login.provider');
    Route::get('/{provider}/callback','handalProviderCallback')->name('user.provider.callback');
});
