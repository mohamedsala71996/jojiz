<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QAController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\BkashController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\PayPalController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AlertAppController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\RazorpayController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\FinancialController;
use App\Http\Controllers\Api\SslcommerzController;
use App\Http\Controllers\Api\PaymentInfoController;
use App\Http\Controllers\Api\SaleSummaryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ChildCategoryController;
use App\Http\Controllers\Api\AttributeValueController;
use App\Http\Controllers\Api\DelivaryChargeController;
use App\Http\Controllers\Api\ForgetPasswordController;
use App\Http\Controllers\Api\ShippingAddressController;

Route::name('api.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login')->name('user.login.submit');
        Route::post('admin-login', 'adminLogin')->name('admin.login.submit');
    });

    // Offer Controller
    Route::apiResource('product-collection',OfferController::class);

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::post('logout', 'logout')->middleware('auth:sanctum');
        Route::get('/', 'dashboard')->middleware('auth:sanctum');
        Route::get('/all-count', 'allCount')->middleware('auth:sanctum');
    });
    Route::controller(AlertAppController::class)->prefix('alert')->group(function () {
        Route::get('/', 'alertApp');
        Route::post('update', 'alertUpdate')->middleware('auth:sanctum');
    });

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::post('update', 'profileUpdate')->middleware('auth:sanctum');
        Route::get('details', 'profileDetails')->middleware('auth:sanctum');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::post('list', 'list');
        Route::post('details', 'singlePage');
        Route::get('sort-type', 'sortType');
        Route::get('collection', 'offerCollection');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::get('product/variation', 'productVariation');
        Route::post('variation/store', 'productVariationStore')->middleware('auth:sanctum');
        Route::post('variation/update', 'variationupdate')->middleware('auth:sanctum');
        Route::post('variation-image-delete', 'variationImageDelete')->name('variation.delete-image')->middleware('auth:sanctum');
    });

    Route::controller(CartController::class)->prefix('cart')->group(function () {
        Route::get('list', 'list')->middleware('auth:sanctum');
        Route::post('addtocart', 'addToCart')->middleware('auth:sanctum');
        Route::post('addtocart/update', 'updateCartItem')->middleware('auth:sanctum');
        Route::get('remove/cart/item/{cart_item}', 'removeCartItem')->middleware('auth:sanctum');
    });

    Route::controller(CheckoutController::class)->prefix('checkout')->group(function () {
        Route::get('list', 'list');
        Route::post('order', 'orderPlace')->middleware('auth:sanctum');
        Route::post('re-order', 'reOrderPlace')->middleware('auth:sanctum');
        Route::post('sslcommerz', 'sslcommerz');
    });
    Route::controller(DelivaryChargeController::class)->group(function () {
        Route::get('delivary-charge', 'delivaryCharge');
        Route::get('delivary-city', 'deliveryCity');
        Route::get('delivary-option', 'deliveryOption');
    });

    Route::controller(WishlistController::class)->prefix('wishlist')->group(function () {
        Route::get('list', 'allWishlist')->middleware('auth:sanctum');
        Route::post('add/wishlist', 'addWishlist')->middleware('auth:sanctum');
        Route::post('remove/wishlist', 'removeWishlist')->middleware('auth:sanctum');
        Route::post('remove/all/wishlist', 'allRemoveWishlist')->middleware('auth:sanctum');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('list', 'list');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::post('update/{id}', 'update')->middleware('auth:sanctum');
    });

    Route::controller(SubCategoryController::class)->prefix('subcategory')->group(function () {
        Route::get('list/{category_id?}', 'list');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::post('update/{id}', 'update')->middleware('auth:sanctum');
    });

    Route::controller(ReviewController::class)->prefix('review')->group(function () {
        Route::post('list', 'list');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::post('update/{id}', 'update')->middleware('auth:sanctum');
    });

    Route::controller(QAController::class)->group(function () {
        Route::get('list', 'list');
        Route::post('question', 'question')->middleware('auth:sanctum');
        Route::post('requestion', 'requestion')->middleware('auth:sanctum');
        Route::post('answer', 'answer')->middleware('auth:sanctum');
    });

    Route::controller(ChildCategoryController::class)->prefix('childcategory')->group(function () {
        Route::get('list', 'list');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::post('update/{id}', 'update')->middleware('auth:sanctum');
    });
    Route::controller(BrandController::class)->prefix('brand')->group(function () {
        Route::get('list', 'list');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::post('update/{id}', 'update')->middleware('auth:sanctum');
    });

    Route::controller(SliderController::class)->prefix('slider')->group(function () {
        Route::get('list', 'list');
    });

    Route::controller(CustomerController::class)->prefix('customer')->group(function () {
        Route::get('list', 'list');
    });

    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('list', 'list');
    });

    Route::controller(CourierController::class)->prefix('courier')->group(function () {
        Route::get('list', 'list');
    });

    Route::controller(AttributeValueController::class)->prefix('product-attribute')->group(function () {
        Route::get('list', 'list');
        Route::get('name-list', 'nameList');
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
    });

    Route::controller(CouponController::class)->prefix('coupon')->group(function () {
        Route::get('list', 'list');
        Route::post('apply', 'couponcheck')->middleware('auth:sanctum');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('admin/stock', 'stock')->middleware('auth:sanctum');
        Route::post('admin/order/list', 'adminOrderList')->middleware('auth:sanctum');
        Route::post('user/order/list', 'userOrderList')->middleware('auth:sanctum');
        Route::post('user/order/cancel', 'userOrderCancel')->middleware('auth:sanctum');
        // Route::get('user/order/invoice', 'userOrderInvoice')->middleware('auth:sanctum');
        Route::post('admin/order/status', 'adminOrderStatus')->middleware('auth:sanctum');

        Route::get('admin/count-order', 'countorder')->middleware('auth:sanctum');
        Route::get('admin/find-order/{slug}', 'findorderbyslug')->middleware('auth:sanctum');
        Route::post('admin/find-order', 'findorderbyslug')->middleware('auth:sanctum');
    });

    Route::controller(SaleSummaryController::class)->prefix('sales')->group(function () {
        Route::get('list', 'list');
        Route::post('yearly-sell', 'yearlySell')->middleware('auth:sanctum');
    });

    Route::controller(CurrencyController::class)->prefix('currency')->group(function () {
        Route::get('list', 'list');
    });
    Route::controller(FinancialController::class)->prefix('financial')->group(function () {
        Route::post('list', 'list');
        Route::get('order-by-category', 'orderbycategory')->middleware('auth:sanctum');
        Route::post('sales-data', 'salesdata')->middleware('auth:sanctum');
    });
    Route::controller(SearchController::class)->group(function () {
        Route::post('search', 'productSearch');
    });
    Route::controller(NotificationController::class)->group(function () {
        Route::get('user-notification', 'userNotification')->middleware('auth:sanctum');
        Route::get('sendNotificationUsers', 'sendNotificationUsers');
    });
    Route::controller(ForgetPasswordController::class)->prefix('forget-password')->group(function () {
        Route::post('send-otp', 'sendOtpCode');
        Route::post('otp-verify', 'verifyOtpCode');
        Route::post('reset-password', 'resetPassword');
    });
    Route::controller(ShippingAddressController::class)->prefix('shipping-address')->group(function () {
        Route::get('list', 'list')->middleware('auth:sanctum');
        Route::post('store', 'store')->middleware('auth:sanctum');
        Route::post('update', 'update')->middleware('auth:sanctum');
        Route::post('destroy', 'destroy')->middleware('auth:sanctum');
    });
    //stripe
    Route::controller(StripeController::class)->group(function () {
        Route::get('stripe/success', 'stripeSuccess')->name('stripe.success');
        Route::get('stripe/cancel', 'stripeCancel')->name('stripe.cancel');
    });
    //RazropayRazorpayController
    Route::controller(RazorpayController::class)->group(function () {
        Route::get('razorpay/success', 'callbackRazorpay')->name('razorpay.success');
        Route::get('razorpay/cancel', 'razorpayCancel')->name('razorpay.cancel');
    });
    Route::controller(PaymentInfoController::class)->middleware('auth:sanctum')->group(function () {
        Route::get('payment-type', 'paymentType');
        Route::get('payment-gateway', 'paymentGateway');
    });
    //Bkash
    Route::get('callback-via-bkash', [BkashController::class, 'callBack']);
    //sslcommerze
    Route::post('/success', [SslcommerzController::class, 'success'])->name('success');
    Route::post('/fail', [SslcommerzController::class, 'fail'])->name('fail');
    Route::post('/cancel', [SslcommerzController::class, 'cancel'])->name('cancel');

    Route::controller(SupplierController::class)->prefix('suppliers')->group(function (){
        Route::get('list', 'list');
        Route::post('store','store');
        Route::post('update/{id}', 'update');
        Route::post('destroy/{id}', 'destroy');
        Route::post('update-status', 'updatestatus');
    });



Route::get('/paypal/success', [PayPalController::class, 'handleSuccess'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'handleCancel'])->name('paypal.cancel');
});
