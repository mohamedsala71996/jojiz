<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\OrangeMoenyController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\BkashTokenizePaymentController;

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('shop', 'shop')->name('shop');
    Route::get('product/details/{slug}', 'productDetails')->name('product.details');
    Route::get('category/{slug}', 'categoryProduct')->name('category.product');
    Route::get('subcategory/{slug}', 'subcategoryProduct')->name('subcategory.product');
    Route::get('product/collection/{id}', 'productCollection')->name('product.collection');
    Route::get('get/products/by-subcategory', 'getsubcategoryproduct');
    Route::get('get/products/by-brand', 'getbrandproduct');
    Route::get('get/products/by-rating', 'getratingproduct');
    Route::get('reset/data/{data}', 'resetdata');
    Route::get('load/varient-data', 'varientdata');
    Route::get('put-data/session', 'savesession');
    Route::get('load-details/{slug}', 'loaddetails');
    Route::get('load-cart', 'loadcart');
    Route::get('stky-load-cart', 'stkyloadcart');
    Route::get('child-category/{slug}', 'childcategoryProduct')->name('childcategory.product');
    Route::get('brand/{slug}', 'brandProduct')->name('brand.product');
    Route::get('contact', 'contact')->name('contact');
    Route::get('faq', 'faq')->name('faq');
    Route::get('search', 'productSearch')->name('product.search');

    Route::get('link/{slug}', 'usefullLink')->name('usefullLink');
});

Route::controller(StripeController::class)->group(function () {
    Route::get('stripe/success', 'stripeSuccess')->name('stripe.success');
    Route::get('stripe/cancel', 'stripeCancel')->name('stripe.cancel');
});

Auth::routes();

// SSLCOMMERZ Start
Route::post('/success', [SslCommerzPaymentController::class, 'success'])->name('sslcommerz.success');
Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('sslcommerz.fail');
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('sslcommerz.cancel');
//SSLCOMMERZ END

// bkash payment
Route::get('callback-bkash', [BkashTokenizePaymentController::class, 'bkashCallBack'])->name('web-bkash-callBack');

//Razorpay payment
Route::post('/razorpay-payment', [RazorpayController::class, 'createPaymentLink'])->name('razorpay.payment');
Route::get('/payment-success', [RazorpayController::class, 'callbackRazorpay'])->name('razorpay.callbackSuccess');
//Orange money payment
Route::post('/orange-money/pay', [OrangeMoenyController::class, 'initiatePayment'])->name('orange.money.pay');
Route::get('/orange-money/callback', [OrangeMoenyController::class, 'handleCallback'])->name('orange.money.callback');

// routes/web.php

Route::get('/paypal/success', [PayPalController::class, 'handleSuccess'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'handleCancel'])->name('paypal.cancel');




//Testing push notification
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/orange', [App\Http\Controllers\HomeController::class, 'initiatePayment'])->name('orange');

Route::get('locale/{lang}',[LocaleController::class,'setLocale'])->name('locale');
