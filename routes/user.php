<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\SiteController;

//All User route
Route::prefix('user')->name('user.')->group(function () {
    Route::get('check-coupon', [SiteController::class, 'couponcheck']);
    Route::get('reset-coupon', [SiteController::class, 'resetcoupon']);

    //Dashboard Controller
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::post('logout', 'logout')->name('logout');
        Route::get('order/{slug}', 'manageorder')->name('manageorder');
        Route::get('give-review/{slug}', 'leavereview')->name('leavereview');
        Route::post('store-review', 'storereview')->name('storereview');
        Route::get('ask-question', 'askquestion')->name('askquestion');
        Route::get('load-question', 'loadquestion')->name('loadquestion');
        Route::get('replay-question', 'replayquestion')->name('replayquestion');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::get('profile/edit/{id}', 'profileEdit')->name('profile.edit');
        Route::post('profile/update/{id}', 'profileUpdate')->name('profile.update');
        Route::get('password/edit/{id}', 'passwordEdit')->name('password.edit');
        Route::post('password/update/{id}', 'passwordUpdate')->name('password.update');
        Route::get('address-book', 'addressBook')->name('address.book');
        Route::post('store/address-book', 'storeAddressBook')->name('store.address.book');
        Route::get('edit/address-book', 'editAddressBook')->name('edit.address.book');
        Route::post('update/address-book', 'updateAddressBook')->name('update.address.book');
        Route::get('cancellation', 'cancellation')->name('cancellation');
        Route::get('my-order', 'myOrder')->name('my.order');
        Route::get('my-wishlist', 'mywishlist')->name('my.wishlist');
        Route::get('my-cancel-order', 'mycancelorder')->name('my.cancelorder');
        Route::get('track-order', 'trackOrder')->name('track.order');
        Route::get('payment-option', 'paymentOption')->name('payment.option');
    });
    Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'addToCartPage')->name('add.to.cart.page');
        Route::post('add/to/cart', 'addToCart')->name('add.to.cart');
        Route::post('add-to-cart', 'addToCart')->name('addocart');
        Route::get('remove/cart/item/{cart_item}', 'removeCartItem')->name('remove.cart.item');
        Route::post('update/cart/item', 'updateCartItem')->name('update.cart.item');
    });
    Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', 'checkoutPage')->name('page');
        Route::post('order/place', 'orderPlace')->name('order.place');
    });
    Route::controller(WishlistController::class)->prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', 'wishlistPage')->name('page');
        Route::get('/load', 'viewwishlist');
        Route::post('add', 'addWishlist')->name('add.wishlist');
        Route::post('remove', 'removeWishlist')->name('remove.wishlist');
        Route::post('all/remove', 'allRemoveWishlist')->name('all.remove.wishlist');
    });
});