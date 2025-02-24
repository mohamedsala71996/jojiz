<?php

use App\Http\Controllers\Admin\AdvancePaymentController;
use App\Http\Controllers\Admin\AlertAppController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DelivaryChargeController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OfferCollectionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OtherDeliveryChargeController;
use App\Http\Controllers\Admin\PaymentCredentialController;
use App\Http\Controllers\Admin\ProductAttributecontroller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\CouponController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//All admin route
Route::prefix('admin')->name('admin.')->group(function () {
    //header menu
    Route::resource('coupons', CouponController::class, ['names' => 'admin.coupons']);
    Route::get('coupon/get/data', [CouponController::class, 'coupondata'])->name('coupon.data');
    Route::post('coupon/{id}', [CouponController::class, 'update']);
    Route::put('coupon/status', [CouponController::class, 'updatestatus']);
    Route::get('q-&-a', [DashboardController::class, 'qna']);
    Route::get('qna/data', [DashboardController::class, 'qnadata']);
    Route::get('qna/edit/{id}', [DashboardController::class, 'qnaedit']);
    Route::post('qna/update/{id}', [DashboardController::class, 'qnaupdate']);

    //Dashboard Controller
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::controller(CurrencyController::class)->prefix('currency')->name('currency.')->group(function () {
        Route::get('edit/{currency}', 'edit')->name('edit');
        Route::post('update/{currency}', 'update')->name('update');
    });
    Route::controller(AdvancePaymentController::class)->prefix('advance-payment')->name('advance-payment.')->group(function () {
        Route::get('edit', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
    });

    Route::controller(AlertAppController::class)->prefix('alert-app')->name('alert.app.')->group(function () {
        Route::get('edit/{alertApp}', 'edit')->name('edit');
        Route::put('update/{alertApp}', 'update')->name('update');
    });

    //Notification Controller
    Route::controller(NotificationController::class)->prefix('notification')->name('notification.')->group(function () {
        Route::get('create', 'create')->name('index');
        Route::get('index', 'index')->name('list');
        Route::post('Send-notification', 'SendNotification')->name('send');
    });
    //Payment Gateway Credentials Controller
    Route::controller(PaymentCredentialController::class)->prefix('payment-credentials')->name('payment.credentials.')->group(function () {
        Route::get('sslcommerz/index', 'sslcommerzIndex')->name('sslcommerz.index');
        Route::post('sslcommerz/update', 'sslcommerzUpdate')->name('sslcommerz.update');

        Route::get('stripe/index', 'stripeIndex')->name('stripe.index');
        Route::post('stripe/update', 'stripeUpdate')->name('stripe.update');

        Route::get('paypal/index', 'paypalIndex')->name('paypal.index');
        Route::post('paypal/update', 'paypalUpdate')->name('paypal.update');

        Route::get('bkash/index', 'bkashIndex')->name('bkash.index');
        Route::post('bkash/update', 'bkashUpdate')->name('bkash.update');

        Route::get('razorpay/index', 'razorpayIndex')->name('razorpay.index');
        Route::post('razorpay/update', 'razorpayUpdate')->name('razorpay.update');

        Route::get('cache-on-delivery/index', 'cashOnDeliveryIndex')->name('cacheOnDelivery.index');
        Route::post('cache-on-delivery/update', 'cashOnDeliveryUpdate')->name('cacheOnDelivery.update');
    });

    //Profile Controller
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('password/edit/{id}', 'passwordEdit')->name('password.edit');
        Route::post('password/update/{id}', 'passwordUpdate')->name('password.update');
    });

    //Slider Controller
    Route::controller(SliderController::class)->prefix('slider')->name('slider.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('slider-ajra-table', 'sliderajraTable')->name('ajra.table');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
    //Collection Controller
    Route::controller(OfferCollectionController::class)->prefix('offer-collection')->name('offer.collection.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::get('show/{id}', 'show')->name('show');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
    //Collection Controller
    Route::controller(UserController::class)->prefix('user-list')->name('user.list.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('export', 'export')->name('export');

    });
    //Category Controller
    Route::get('/get/subcategory/{id}', [CategoryController::class, 'getsubcategory']);
    Route::get('/get/childcategory/{id}', [CategoryController::class, 'getchildcategory']);

    Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/ajra-table', 'ajraTable')->name('ajra.table');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{category_id}', 'destroy')->name('destroy');
        Route::post('type/update', 'typeUpdate')->name('type.update');

        Route::post('post-reorder', 'reorder')->name('reorder');
    });

    //Sub Category Controller
    Route::controller(SubCategoryController::class)->prefix('subcategory')->name('subcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('subcategory-ajra-able', 'subCategoryAjraTable')->name('subcategory.ajra.table');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    //Attribute Controller
    Route::controller(ProductAttributecontroller::class)->prefix('productattribute')->name('productattribute.')->group(function () {
        Route::get('attribute-name', 'attributeName')->name('attribute.name');
        Route::get('attribute-name-yjra-table', 'attributeNameYjraTable')->name('attribute.name.yjra.table');
        Route::get('attribute-name-edit/{id}', 'attributeNameEdit')->name('attribute.name.edit');
        Route::post('attribute-name-update/{id}', 'attributeNameUpdate')->name('attribute.name.update');
        Route::delete('attribute-name-destroy/{id}', 'attributeNameDestroy')->name('attribute.name.destroy');

        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('productattribute-ajra-able', 'productattributeAjraTable')->name('productattribute.ajra.table');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    //Chiled Category Controller
    Route::controller(ChildCategoryController::class)->prefix('childcategory')->name('childcategory.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('ajra-table', 'childcategoryajraTable')->name('yajra.table');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
    //Usefull Controller

    Route::controller(UsefulLinkController::class)->prefix('usefullink')->name('usefullink.')->group(function () {
        Route::get('index', 'index')->name("index");
        Route::get('create', 'create')->name("create");
        Route::post('store', 'store')->name("store");
        Route::get('edit/{id}', 'edit')->name("edit");
        Route::post('update/{id}', 'update')->name("update");
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
    //FAQ Controller
    Route::resource('faqs', FaqController::class);
    Route::post('faqs/{id}', [FaqController::class, 'update'])->name('faq.update');

    //Brand Controller
    Route::controller(BrandController::class)->prefix('brand')->name('brand.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('brand-ajra-table', 'brandAjraTable')->name('brand.ajra.table');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });
                                                                                                              //Product Controller
    Route::get('product-info/{slug}', [ProductController::class, 'slugproduct'])->name('slugproduct');        //get getsize data using datatables
    Route::get('download-product-excel', [ProductController::class, 'downloadexcel'])->name('downloadexcel'); //get getsize data using datatables
    Route::get('download-product', [ProductController::class, 'downloadproduct'])->name('downloadproduct');   //get getsize data using datatables
    Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/product-details', 'productDetails')->name('productDetails');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('variation', 'variation')->name('variation');
        Route::post('variation-update', 'variationupdate')->name('variationupdate');
        Route::delete('veriation-destroy/{id}', 'variationdelete')->name('variationdelete');
        Route::delete('size-destroy/{id}', 'sizedelete')->name('sizedelete');
        Route::delete('weight-destroy/{id}', 'weightdelete')->name('weightdelete');
        Route::get('load-variation', 'loadvariation')->name('loadvariation');
        Route::put('product-variation/status', 'variationstatus')->name('variationstatus');
        Route::get('variation/edit/{id}', 'variationview')->name('variationview');
        Route::get('variation/view/{id}', 'viewver')->name('viewver');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::get('view-details/{id}', 'viewdetails')->name('viewdetails');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::get('get-data', 'productdata')->name('data');
        Route::put('status', 'statusupdate')->name('status');
        Route::post('/variation-image-delete', 'variationImageDelete')->name('variation.delete-image');

    });

    //General Setting Controller
    Route::controller(GeneralSettingController::class)->prefix('general/setting')->name('general.setting.')->group(function () {
        Route::get('/', 'basicSetting')->name('basic.setting');
        Route::put('basic-settings/update', 'basicSettingUpdate')->name('basic.setting.update');
        Route::get('image/asset', 'imageAsset')->name('image.asset');
        Route::put('image/asset/update', 'imageAssetUpdate')->name('image.asset.update');
        Route::put('facicon/update', 'faviconUpdate')->name('favicon.update');
        Route::get('mail-config-page', 'mailConfigPage')->name('mail.config.page');
        Route::post('mail-config-update', 'mailConfigUpdate')->name('mail.config.update');
        Route::post('app-download/{id}', 'appDownload')->name('app.download');
    });

    // basic info
    Route::resource('web-settings', GeneralSettingController::class, ['names' => 'websettings']);
    Route::post('meta-tags/{id}', [GeneralSettingController::class, 'metatag']);
    Route::post('pixel/analytics/{id}', [GeneralSettingController::class, 'pixelanalytics']);
    Route::post('web-settings/update/{id}', [GeneralSettingController::class, 'updatesite']);
    Route::post('social-settings/update/{id}', [GeneralSettingController::class, 'sociallink']);

                                                                                           //variation data
    Route::get('get/sizes', [ProductController::class, 'getsize'])->name('getsize');       //get getsize data using datatables
    Route::get('get/weights', [ProductController::class, 'getweight'])->name('getweight'); //get getsize data using datatables
//Okay
    //Courier Controller
    Route::resource('couriers', CourierController::class);                //resource
    Route::resource('delivery-charges', DelivaryChargeController::class); //resource
    Route::controller(OtherDeliveryChargeController::class)->prefix('other-delivery-charge')->name('other.delivery.charge.')->group(function () {
        Route::get('edit', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
    });
    Route::get('get/courier-data', [CourierController::class, 'courierdata'])->name('courier.data'); //get courier data using datatables
    Route::post('courier/{id}', [CourierController::class, 'update']);                               //update courier info
    Route::put('courier/status', [CourierController::class, 'updatestatus']);                        //change courier status
                                                                                                     //City Controller
    Route::resource('cities', CityController::class);
    Route::get('get/city-data', [CityController::class, 'citydata'])->name('city.data'); //get city data using datatables
    Route::post('city/{id}', [CityController::class, 'update']);                         //update city info
    Route::put('city/status', [CityController::class, 'updatestatus']);                  //change city status
    Route::get('/set-value/city/{id}', [CityController::class, 'getCityByCurier']);
    //Zone Controller
    Route::resource('zones', ZoneController::class);
    Route::get('get/zone-data', [ZoneController::class, 'zonedata'])->name('zone.data'); //get zone data using datatables
    Route::post('zone/{id}', [ZoneController::class, 'update']);                         //update zone info
    Route::put('zone/status', [ZoneController::class, 'updatestatus']);                  //change zone status
    Route::get('/set-value/zone/{id}', [ZoneController::class, 'getZoneByCurier']);
    //Area Controller
    Route::resource('areas', AreaController::class);
    Route::get('get/area-data', [AreaController::class, 'areadata'])->name('area.data'); //get area data using datatables
    Route::post('area/{id}', [AreaController::class, 'update']);                         //update area info
    Route::put('area/status', [AreaController::class, 'updatestatus']);                  //change area status

    // orders
    Route::resource('orders', OrderController::class);
    Route::get('orders/status/{status?}', [OrderController::class, 'orderStatus'])->name('orders.status');

    Route::get('create/order', [OrderController::class, 'create']);
    Route::post('order/store', [OrderController::class, 'store']);
    Route::get('order/couriers', [OrderController::class, 'couriers']);
    Route::get('order/cities', [OrderController::class, 'city']);
    Route::get('order/users', [OrderController::class, 'users']);
    Route::get('order/zones', [OrderController::class, 'zone']);
    Route::get('order/areas', [OrderController::class, 'area']);
    Route::get('order/count', [OrderController::class, 'countorder']);
    Route::get('online/orders', [OrderController::class, 'onlineorder']);
    Route::get('order/getComment', [OrderController::class, 'getComment']);
    Route::get('order-update/comment', [OrderController::class, 'updateComment']);
    Route::get('product/topsell/{id}', [OrderController::class, 'topsellpeoduct']);
    Route::get('online/orders-data', [OrderController::class, 'onlineorderdata']);
    Route::get('order/product-lists', [OrderController::class, 'orderproduct']);
    Route::get('order/product-lists/data', [OrderController::class, 'orderproductdata']);
    Route::get('order/products', [OrderController::class, 'admproduct']);
    Route::get('order-details/{id}', [OrderController::class, 'details']);
    Route::post('order-update/{id}', [OrderController::class, 'update']);
    Route::get('order/assign_user', [OrderController::class, 'assignuser']);
    Route::get('order/status', [OrderController::class, 'updateorderstatus']);
    Route::get('admin_order/{status}', [OrderController::class, 'ordersByStatus']);
    Route::get('order/{status}', [OrderController::class, 'orderdata'])->name('admin_order.info');
    Route::delete('order/destroy/{id}', [OrderController::class, 'destroy']);

    //Supplier Controller
    Route::resource('suppliers', SupplierController::class);
    Route::controller(SupplierController::class)->group(function () {
        Route::post('supplier/{id}', 'update');
        Route::put('supplier/status', 'updatestatus');
        Route::get('supplier-data', 'supplierdata')->name('supplier.info');
        Route::get('supplier/ledger/{id}', 'supplierLedger')->name('purchase.ledger');
    });

    // Cache Clear Section
    Route::get('cache/clear', function () {
        Artisan::all('cache:clear');
        Artisan::all('route:clear');
        Artisan::all('view:clear');
        Artisan::all('config:clear');
        Toastr::success(__("backend.Cache Clear Successfully!"));
        return redirect()->back();
    })->name('cache.clear');

    // supplier payment
    //   Route::controller(SupplierPaymentController::class)->group(function () {
    //     Route::get('supplier-payment', 'store')->name('supplierpayment.store');
    // });
    // //purchess
    // Route::resource('purchases', PurchaseController::class);
    // Route::controller(PurchaseController::class)->group(function () {
    //     Route::post('purchase-store', 'store');
    //     Route::post('purchase/{id}', 'update');
    //     Route::get('purchase-data', 'purchasedata')->name('purchese.info');
    //     Route::get('purchase-create', 'create');
    //     Route::get('get-suppliers', 'suppliers');
    // });

    // //stocks
    // Route::resource('stocks', StockController::class);
    // Route::controller(StockController::class)->group(function () {
    //     Route::get('stock-data', 'stockdata')->name('stock.info');
    // });

});
