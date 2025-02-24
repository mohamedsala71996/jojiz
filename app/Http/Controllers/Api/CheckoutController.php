<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Admin\Admin;
use App\Models\Admin\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Ordernote;
use App\Models\Orderproduct;
use App\Models\ShippingAddress;
use App\Models\Size;
use App\Models\TemporaryData;
use App\Models\Usecoupon;
use App\Models\User\Notification;
use App\Traits\PaymentGateway\Bkash;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    use Bkash;

    public function orderPlace(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'shipping_address_id' => 'required|integer',
            'payment_type' => 'required',
            'delivery_charge' => 'required',
        ])->validate();

        $carts = Cart::where('user_id', auth()->user()->id)->get();

        if (count($carts) == 0) {
            return ApiResponse::created("Opps! You don't select any product", null, false);

        }

        foreach ($carts as $cart) {
            // Retrieve the specific product and size record
            $product = Product::where('id', $cart->product_id)->first();
            $size = Size::where('id', $cart->size_id)->first();

            if (!$size || $size->stock < $cart->qty || !$product || $product->total_stock < $cart->qty) {
                // Handle the case where there's not enough stock

                return ApiResponse::created('Product Name: ' . $product->product_name . ' Size: ' . $size->size . ' ' . 'Stock Out', null, false);
            }
        }

        $shippind_address = ShippingAddress::find($validated['shipping_address_id']);
        $validated['name'] = $shippind_address->name;
        $validated['email'] = $shippind_address->email;
        $validated['phone'] = $shippind_address->phone;
        $validated['address'] = $shippind_address->address;
        $validated['city'] = $shippind_address->city;
        $validated['district'] = $shippind_address->district;
        $validated['shippingCharge'] = $validated['delivery_charge'];

        if ($request->payment_type == 'cash_on_delivery') {

            $superadmin_id = Admin::first();
            $validated['admin_id'] = $superadmin_id->id;
            $validated['invoiceID'] = generateUniqueID(6);
            $validated['subTotal'] = cartSubTotal();
            $validated['orderDate'] = date('Y-m-d');
            $validated['payment_method'] = $validated['payment_type'];

            $order = Order::create($validated);

            $order->web_id = 1;
            $order->user_id = Auth::user()->id;
            $order->order_note = $request->order_none;
            $basic_setting = GeneralSetting::first();

            $coupon = TemporaryData::where('user_id', auth()->user()->id)->first();

            $order->discount = $coupon->discount ?? 0;
            $order->coupon = $coupon->coupon_code ?? null;
            $order->vat = $basic_setting->vat_status == 'ON' ? $basic_setting->vat : 0;
            $order->tax = $basic_setting->tax_status == 'ON' ? $basic_setting->tax : 0;

            $order->total = (cartSubTotal() + $basic_setting->vat + $basic_setting->tax + $validated['delivery_charge']) - ($coupon->discount ?? 0);
            if (isset($request->advance_payment) && $request->advance_payment == 1) {
                if ($basic_setting->advance_payment_type == 'percentage') {
                    $advance_payment = ($basic_setting->advance_payment / 100) * $order->total;
                    $order->paidAmount = $advance_payment;
                    $order->due_amount = $order->total - $order->paidAmount;
                    $order->advance_payment_amount = $advance_payment;
                    $order->advance_payment_status = 1;

                } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                    $order->paidAmount = productWiseAdvancePaymentAmount();
                    $order->due_amount = $order->total - productWiseAdvancePaymentAmount();
                    $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                    $order->advance_payment_status = 1;
                } else {
                    $order->paidAmount = $basic_setting->advance_payment;
                    $order->due_amount = $order->total - $basic_setting->advance_payment;
                    $order->advance_payment_amount = $basic_setting->advance_payment;
                    $order->advance_payment_status = 1;
                }
            } else {

                $order->paidAmount = $order->total;
                $order->due_amount = 0;
            }

            $order->update();
            $codein = $coupon->coupon_code ?? null;
            if (isset($codein)) {
                $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                if (isset($use)) {
                } else {
                    $couponuse = new Usecoupon();
                    $couponuse->user_id = Auth::id();
                    $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                    $couponuse->code = $coupon->coupon_code;
                    $couponuse->date = date('Y-m-d');
                    $couponuse->save();
                }
            }

            $customar = Customer::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'customerName' => auth()->user()->name,
                'customerEmail' => auth()->user()->email,
                'customerPhone' => auth()->user()->phone,
            ]);
            $ordernote = Ordernote::create([
                'order_id' => $order->id,
                'comment' => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                'admin_id' => $superadmin_id->id,
            ]);

            foreach ($carts as $cart) {
                // Retrieve the specific stock record for the product and size
                $size = Size::where('id', $cart->size_id)->first();
                $product = Product::where('id', $cart->product_id)->first();

                // Check if the size exists and if there's enough stock
                if ($size && $size->stock >= $cart->qty) {
                    // Decrease the size stock by the quantity ordered
                    $size->stock -= $cart->qty;
                    $size->sold += $cart->qty;
                    $size->save(); // Save the updated size stock

                    // Decrease the product's total stock by the quantity ordered
                    $product->total_stock -= $cart->qty;
                    $product->sold += $cart->qty;
                    $product->save(); // Save the updated total stock

                    // Create a new order product record
                    $orp = new Orderproduct();
                    $orp->order_id = $order->id;
                    $orp->product_id = $cart->product_id;
                    $orp->productName = $this->productname($cart->product_id);
                    $orp->color = $cart->color;
                    $orp->size_id = $cart->size_id;
                    $orp->size = $cart->size;
                    $orp->code_id = $cart->code_id;
                    $orp->code = $cart->code;
                    $orp->weight_id = $cart->weight_id;
                    $orp->weight = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price = $cart->price;
                    $orp->qty = $cart->qty;
                    $orp->save();
                } else {
                    // Handle the case where there's not enough stock
                    throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                }
            }

            Notification::create([
                'user_id' => auth()->user()->id,
                'title' => 'Order Successfull',
                'type' => 'order',
                'invoice' => $order->invoiceID,
            ]);

            TemporaryData::where('user_id', auth()->user()->id)->delete();
            Cart::where('user_id', auth()->user()->id)->delete();
            return ApiResponse::created('Order Create Successfully');

        } else if ('sslcommerz' == $request->payment_type) {

            // $shippind_address = ShippingAddress::find($validated['shipping_address_id']);
            // $validated['name'] = $shippind_address->name;
            // $validated['email'] = $shippind_address->email;
            // $validated['phone'] = $shippind_address->phone;
            // $validated['address'] = $shippind_address->address;
            // $validated['city'] = $shippind_address->city;
            // $validated['district'] = $shippind_address->district;
            // $validated['shippingCharge'] = $validated['delivery_charge'];

            $superadmin_id = Admin::first();
            $validated['admin_id'] = $superadmin_id->id;
            $validated['invoiceID'] = generateUniqueID(6);
            $validated['subTotal'] = cartSubTotal();
            $validated['orderDate'] = date('Y-m-d');
            $validated['payment_method'] = $validated['payment_type'];

            $order = Order::create($validated);

            $order->web_id = 1;
            $order->user_id = Auth::user()->id;
            $order->order_note = $request->order_none;
            $basic_setting = GeneralSetting::first();

            $coupon = TemporaryData::where('user_id', auth()->user()->id)->first();

            $order->discount = $coupon->discount ?? 0;
            $order->coupon = $coupon->coupon_code ?? null;
            $order->vat = $basic_setting->vat_status == 'ON' ? $basic_setting->vat : 0;
            $order->tax = $basic_setting->tax_status == 'ON' ? $basic_setting->tax : 0;
            $order->total = (cartSubTotal() + $basic_setting->vat + $basic_setting->tax + $validated['delivery_charge']) - ($coupon->discount ?? 0);
            //for advance payment
            if (isset($request->advance_payment) && $request->advance_payment == 1) {
                if ($basic_setting->advance_payment_type == 'percentage') {
                    $advance_payment = ($basic_setting->advance_payment / 100) * $order->total;
                    $payable_amount = $advance_payment;
                    $order->paidAmount = $advance_payment;
                    $order->due_amount = $order->total - $order->paidAmount;
                    $order->advance_payment_amount = $advance_payment;
                    $order->advance_payment_status = 1;

                } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                    $payable_amount = productWiseAdvancePaymentAmount();
                    $order->paidAmount = productWiseAdvancePaymentAmount();
                    $order->due_amount = $order->total - productWiseAdvancePaymentAmount();
                    $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                    $order->advance_payment_status = 1;
                } else {
                    $payable_amount = $basic_setting->advance_payment;
                    $order->paidAmount = $basic_setting->advance_payment;
                    $order->due_amount = $order->total - $basic_setting->advance_payment;
                    $order->advance_payment_amount = $basic_setting->advance_payment;
                    $order->advance_payment_status = 1;
                }
            } else {
                $payable_amount = $order->total;
                $order->paidAmount = $order->total;
                $order->due_amount = 0;
            }
            $order->update();
            $codein = $coupon->coupon_code ?? null;
            if (isset($codein)) {
                $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                if (isset($use)) {
                } else {
                    $couponuse = new Usecoupon();
                    $couponuse->user_id = Auth::id();
                    $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                    $couponuse->code = $coupon->coupon_code;
                    $couponuse->date = date('Y-m-d');
                    $couponuse->save();
                }
            }
            $customar = Customer::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'customerName' => auth()->user()->name,
                'customerEmail' => auth()->user()->email,
                'customerPhone' => auth()->user()->phone,
            ]);
            $ordernote = Ordernote::create([
                'order_id' => $order->id,
                'comment' => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                'admin_id' => $superadmin_id->id,
            ]);

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                // Retrieve the specific stock record for the product and size
                $size = Size::where('id', $cart->size_id)->first();
                $product = Product::where('id', $cart->product_id)->first();

                // Check if the size exists and if there's enough stock
                if ($size && $size->stock >= $cart->qty) {
                    // Decrease the size stock by the quantity ordered
                    $size->stock -= $cart->qty;
                    $size->sold += $cart->qty;
                    $size->save(); // Save the updated size stock

                    // Decrease the product's total stock by the quantity ordered
                    $product->total_stock -= $cart->qty;
                    $product->sold += $cart->qty;
                    $product->save(); // Save the updated total stock

                    // Create a new order product record
                    $orp = new Orderproduct();
                    $orp->order_id = $order->id;
                    $orp->product_id = $cart->product_id;
                    $orp->productName = $this->productname($cart->product_id);
                    $orp->color = $cart->color;
                    $orp->size_id = $cart->size_id;
                    $orp->size = $cart->size;
                    $orp->code_id = $cart->code_id;
                    $orp->code = $cart->code;
                    $orp->weight_id = $cart->weight_id;
                    $orp->weight = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price = $cart->price;
                    $orp->qty = $cart->qty;
                    $orp->save();
                } else {
                    // Handle the case where there's not enough stock
                    throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                }
            }

            $paymentCredentials = DB::table('payment_credentials')
                ->where('gateway', 'sslcommerz')
                ->first()->credentials;
            $paymentCredentials = json_decode($paymentCredentials);
            if ($paymentCredentials->is_localhost == 'live') {
                $payment_url = 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';
            } else {
                $payment_url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';
            }
            $client = new Client();
            $response = $client->post($payment_url, [
                'form_params' => [
                    'store_id' => $paymentCredentials->store_id,
                    'store_passwd' => $paymentCredentials->store_password,
                    'total_amount' => intval($payable_amount),
                    'currency' => 'BDT',
                    'tran_id' => $validated['invoiceID'],
                    'success_url' => route('api.success'),
                    'fail_url' => route('api.fail'),
                    'cancel_url' => route('api.cancel'),
                    'emi_option' => 0,
                    'cus_name' => $validated['name'],
                    'cus_email' => $validated['email'],
                    'cus_add1' => $validated['address'],
                    'cus_city' => $validated['city'],
                    'shipping_method' => 'NO',
                    'product_name' => $this->productname($cart->product_id),
                    'product_category' => $this->category($cart->product_id),
                    'product_profile' => $this->category($cart->product_id),
                    'cus_country' => $validated['address'],
                    'cus_phone' => $validated['phone'],
                    'ship_name' => $validated['name'],
                    'ship_add1' => $validated['address'],
                    'ship_city' => $validated['city'],
                    'ship_country' => $validated['address'],
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            $data = [
                'status' => $result['status'],
                'logo' => $result['storeLogo'],
                'redirect_url' => $result['GatewayPageURL'],
            ];

            TemporaryData::where('user_id', auth()->user()->id)->delete();
            Cart::where('user_id', auth()->user()->id)->delete();

            if (isset($result['GatewayPageURL']) && $result['GatewayPageURL'] != "") {
                return ApiResponse::created(null, $data);
            } else {
                return ApiResponse::created('Semething Went Wrong,Please try again', $data);
            }
        } else if ('stripe' == $request->payment_type) {

            $superadmin_id = Admin::first();
            $validated['admin_id'] = $superadmin_id->id;
            $validated['invoiceID'] = generateUniqueID(6);
            $validated['subTotal'] = cartSubTotal();
            $validated['orderDate'] = date('Y-m-d');
            $validated['payment_method'] = $validated['payment_type'];

            $order = Order::create($validated);

            $order->web_id = 1;
            $order->user_id = Auth::user()->id;
            $order->order_note = $request->order_none;
            $order->status = "Pending";
            $basic_setting = GeneralSetting::first();

            $coupon = TemporaryData::where('user_id', auth()->user()->id)->first();

            $order->discount = $coupon->discount ?? 0;
            $order->coupon = $coupon->coupon_code ?? null;
            $order->vat = $basic_setting->vat_status == 'ON' ? $basic_setting->vat : 0;
            $order->tax = $basic_setting->tax_status == 'ON' ? $basic_setting->tax : 0;

            $order->total = (cartSubTotal() + $basic_setting->vat + $basic_setting->tax + $validated['delivery_charge']) - ($coupon->discount ?? 0);
            //Advance payment
            if (isset($request->advance_payment) && $request->advance_payment == 1) {
                if ($basic_setting->advance_payment_type == 'percentage') {
                    $advance_payment = ($basic_setting->advance_payment / 100) * $order->total;
                    $payable_amount = $advance_payment;
                    $order->paidAmount = $advance_payment;
                    $order->due_amount = $order->total - $order->paidAmount;
                    $order->advance_payment_amount = $advance_payment;
                    $order->advance_payment_status = 1;

                } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                    $payable_amount = productWiseAdvancePaymentAmount();
                    $order->paidAmount = productWiseAdvancePaymentAmount();
                    $order->due_amount = $order->total - productWiseAdvancePaymentAmount();
                    $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                    $order->advance_payment_status = 1;
                } else {
                    $payable_amount = $basic_setting->advance_payment;
                    $order->paidAmount = $basic_setting->advance_payment;
                    $order->due_amount = $order->total - $basic_setting->advance_payment;
                    $order->advance_payment_amount = $basic_setting->advance_payment;
                    $order->advance_payment_status = 1;
                }
            } else {
                $payable_amount = $order->total;
                $order->paidAmount = $order->total;
                $order->due_amount = 0;
            }
            $order->update();
            $codein = $coupon->coupon_code ?? null;
            if (isset($codein)) {
                $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                if (isset($use)) {
                } else {
                    $couponuse = new Usecoupon();
                    $couponuse->user_id = Auth::id();
                    $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                    $couponuse->code = $coupon->coupon_code;
                    $couponuse->date = date('Y-m-d');
                    $couponuse->save();
                }
            }

            $customar = Customer::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'customerName' => auth()->user()->name,
                'customerEmail' => auth()->user()->email,
                'customerPhone' => auth()->user()->phone,
            ]);
            $ordernote = Ordernote::create([
                'order_id' => $order->id,
                'comment' => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                'admin_id' => $superadmin_id->id,
            ]);

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                // Retrieve the specific stock record for the product and size
                $size = Size::where('id', $cart->size_id)->first();
                $product = Product::where('id', $cart->product_id)->first();

                // Check if the size exists and if there's enough stock
                if ($size && $size->stock >= $cart->qty) {
                    // Decrease the size stock by the quantity ordered
                    $size->stock -= $cart->qty;
                    $size->sold += $cart->qty;
                    $size->save(); // Save the updated size stock

                    // Decrease the product's total stock by the quantity ordered
                    $product->total_stock -= $cart->qty;
                    $product->sold += $cart->qty;
                    $product->save(); // Save the updated total stock

                    // Create a new order product record
                    $orp = new Orderproduct();
                    $orp->order_id = $order->id;
                    $orp->product_id = $cart->product_id;
                    $orp->productName = $this->productname($cart->product_id);
                    $orp->color = $cart->color;
                    $orp->size_id = $cart->size_id;
                    $orp->size = $cart->size;
                    $orp->code_id = $cart->code_id;
                    $orp->code = $cart->code;
                    $orp->weight_id = $cart->weight_id;
                    $orp->weight = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price = $cart->price;
                    $orp->qty = $cart->qty;
                    $orp->save();
                } else {
                    // Handle the case where there's not enough stock
                    throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                }
            }

            $paymentCredentials = DB::table('payment_credentials')
                ->where('gateway', 'stripe')
                ->first()->credentials;
            $paymentCredentials = json_decode($paymentCredentials);

            $stripe = new \Stripe\StripeClient($paymentCredentials->secret_key);
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => ['name' => 'Amount'],
                            'unit_amount' => (intval($payable_amount) * 100),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('api.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('api.stripe.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
                'metadata' => [
                    // 'order' => $order,
                    'user_id' => auth()->user()->id,
                    'invoiceID' => $order->invoiceID,

                ],
            ]);

            TemporaryData::where('user_id', auth()->user()->id)->delete();
            Cart::where('user_id', auth()->user()->id)->delete();

            if (isset($response->id)) {
                $data = [
                    'redirect_url' => $response->url,
                ];

                return ApiResponse::created(null, $data);
            } else {
                return ApiResponse::created('Oops, Something Went Wrong.Please try again', null);
            }

        } else if ('bkash' == $request->payment_type) {

            // $shippind_address = ShippingAddress::find($validated['shipping_address_id']);
            // $validated['name'] = $shippind_address->name;
            // $validated['email'] = $shippind_address->email;
            // $validated['phone'] = $shippind_address->phone;
            // $validated['address'] = $shippind_address->address;
            // $validated['city'] = $shippind_address->city;
            // $validated['district'] = $shippind_address->district;
            // $validated['shippingCharge'] = $validated['delivery_charge'];

            $superadmin_id = Admin::first();
            $validated['admin_id'] = $superadmin_id->id;
            $validated['invoiceID'] = generateUniqueID(6);
            $validated['subTotal'] = cartSubTotal();
            $validated['orderDate'] = date('Y-m-d');
            $validated['payment_method'] = $validated['payment_type'];

            $order = Order::create($validated);

            $order->web_id = 1;
            $order->user_id = Auth::user()->id;
            $order->order_note = $request->order_none;
            $order->status = "Pending";
            $basic_setting = GeneralSetting::first();

            $coupon = TemporaryData::where('user_id', auth()->user()->id)->first();

            $order->discount = $coupon->discount ?? 0;
            $order->coupon = $coupon->coupon_code ?? null;
            $order->vat = $basic_setting->vat_status == 'ON' ? $basic_setting->vat : 0;
            $order->tax = $basic_setting->tax_status == 'ON' ? $basic_setting->tax : 0;

            $order->total = (cartSubTotal() + $basic_setting->vat + $basic_setting->tax + $validated['delivery_charge']) - ($coupon->discount ?? 0);
            //Advance payment
            if (isset($request->advance_payment) && $request->advance_payment == 1) {
                if ($basic_setting->advance_payment_type == 'percentage') {
                    $advance_payment = ($basic_setting->advance_payment / 100) * $order->total;
                    $payable_amount = $advance_payment;
                    $order->paidAmount = $advance_payment;
                    $order->due_amount = $order->total - $order->paidAmount;
                    $order->advance_payment_amount = $advance_payment;
                    $order->advance_payment_status = 1;

                } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                    $payable_amount = productWiseAdvancePaymentAmount();
                    $order->paidAmount = productWiseAdvancePaymentAmount();
                    $order->due_amount = $order->total - productWiseAdvancePaymentAmount();
                    $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                    $order->advance_payment_status = 1;
                } else {
                    $payable_amount = $basic_setting->advance_payment;
                    $order->paidAmount = $basic_setting->advance_payment;
                    $order->due_amount = $order->total - $basic_setting->advance_payment;
                    $order->advance_payment_amount = $basic_setting->advance_payment;
                    $order->advance_payment_status = 1;
                }
            } else {
                $payable_amount = $order->total;
                $order->paidAmount = $order->total;
                $order->due_amount = 0;
            }
            $order->update();
            $codein = $coupon->coupon_code ?? null;
            if (isset($codein)) {
                $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                if (isset($use)) {
                } else {
                    $couponuse = new Usecoupon();
                    $couponuse->user_id = Auth::id();
                    $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                    $couponuse->code = $coupon->coupon_code;
                    $couponuse->date = date('Y-m-d');
                    $couponuse->save();
                }
            }

            $customar = Customer::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'customerName' => auth()->user()->name,
                'customerEmail' => auth()->user()->email,
                'customerPhone' => auth()->user()->phone,
            ]);
            $ordernote = Ordernote::create([
                'order_id' => $order->id,
                'comment' => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                'admin_id' => $superadmin_id->id,
            ]);

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                // Retrieve the specific stock record for the product and size
                $size = Size::where('id', $cart->size_id)->first();
                $product = Product::where('id', $cart->product_id)->first();

                // Check if the size exists and if there's enough stock
                if ($size && $size->stock >= $cart->qty) {
                    // Decrease the size stock by the quantity ordered
                    $size->stock -= $cart->qty;
                    $size->sold += $cart->qty;
                    $size->save(); // Save the updated size stock

                    // Decrease the product's total stock by the quantity ordered
                    $product->total_stock -= $cart->qty;
                    $product->sold += $cart->qty;
                    $product->save(); // Save the updated total stock

                    // Create a new order product record
                    $orp = new Orderproduct();
                    $orp->order_id = $order->id;
                    $orp->product_id = $cart->product_id;
                    $orp->productName = $this->productname($cart->product_id);
                    $orp->color = $cart->color;
                    $orp->size_id = $cart->size_id;
                    $orp->size = $cart->size;
                    $orp->code_id = $cart->code_id;
                    $orp->code = $cart->code;
                    $orp->weight_id = $cart->weight_id;
                    $orp->weight = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price = $cart->price;
                    $orp->qty = $cart->qty;
                    $orp->save();
                } else {
                    // Handle the case where there's not enough stock
                    throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                }
            }

            $paymentData = [
                'mode' => '0011', // Mode for tokenized checkout
                'payerReference' => $order->invoiceID,
                'intent' => 'sale',
                'currency' => 'BDT',
                'amount' => $payable_amount,
                'merchantInvoiceNumber' => $order->invoiceID,
                'callbackURL' => route('api.bkash-callBack', [
                    'user_id' => $order->user_id,
                    'couponcode' => Session::get('couponcode'),
                    'availablecoupon' => Session::get('availablecoupon'),
                ]),
            ];

            $paymentCredentials = DB::table('payment_credentials')
                ->where('gateway', 'bkash')
                ->first()->credentials;
            $paymentCredentials = json_decode($paymentCredentials);
            if ($paymentCredentials->is_localhost == 'live') {
                $payment_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/create';
            } else {
                $payment_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/create';
            }

            try {
                $accessToken = $this->getAccessToken();

                // Make the payment request to bKash
                $client = new Client();
                $response = $client->post($payment_url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                        'X-APP-Key' => $paymentCredentials->app_key, // Add X-APP-Key header here
                    ],
                    'body' => json_encode($paymentData),
                ]);

                $responseData = json_decode($response->getBody()->getContents(), true);

                if (isset($responseData['bkashURL'])) {

                    $data = [
                        'redirect_url' => $responseData['bkashURL'],
                    ];
                    return ApiResponse::created(null, $data);
                    // Handle response for Website or API

                } else {

                    return ApiResponse::error('Unable to create payment. Please try again.');
                }
            } catch (\Exception $e) {

                return ApiResponse::error($e->getMessage());
            }

        } else if ('razorpay' == $request->payment_type) {

            // $shippind_address = ShippingAddress::find($validated['shipping_address_id']);
            // $validated['name'] = $shippind_address->name;
            // $validated['email'] = $shippind_address->email;
            // $validated['phone'] = $shippind_address->phone;
            // $validated['address'] = $shippind_address->address;
            // $validated['city'] = $shippind_address->city;
            // $validated['district'] = $shippind_address->district;
            // $validated['shippingCharge'] = $shippind_address->delivery_charge;

            $superadmin_id = Admin::first();
            $validated['admin_id'] = $superadmin_id->id;
            $validated['invoiceID'] = generateUniqueID(6);
            $validated['subTotal'] = cartSubTotal();
            $validated['orderDate'] = date('Y-m-d');
            $validated['payment_method'] = $validated['payment_type'];

            $order = Order::create($validated);

            $order->web_id = 1;
            $order->user_id = Auth::user()->id;
            $order->order_note = $request->order_none;
            $order->status = "Pending";
            $basic_setting = GeneralSetting::first();

            $coupon = TemporaryData::where('user_id', auth()->user()->id)->first();

            $order->discount = $coupon->discount ?? 0;
            $order->coupon = $coupon->coupon_code ?? null;
            $order->vat = $basic_setting->vat_status == 'ON' ? $basic_setting->vat : 0;
            $order->tax = $basic_setting->tax_status == 'ON' ? $basic_setting->tax : 0;

            $order->total = (cartSubTotal() + $basic_setting->vat + $basic_setting->tax + $validated['delivery_charge']) - ($coupon->discount ?? 0);
            //Advance payment
            if (isset($request->advance_payment) && $request->advance_payment == 1) {
                if ($basic_setting->advance_payment_type == 'percentage') {
                    $advance_payment = ($basic_setting->advance_payment / 100) * $order->total;
                    $payable_amount = $advance_payment;
                    $order->paidAmount = $advance_payment;
                    $order->due_amount = $order->total - $order->paidAmount;
                    $order->advance_payment_amount = $advance_payment;
                    $order->advance_payment_status = 1;

                } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                    $payable_amount = productWiseAdvancePaymentAmount();
                    $order->paidAmount = productWiseAdvancePaymentAmount();
                    $order->due_amount = $order->total - productWiseAdvancePaymentAmount();
                    $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                    $order->advance_payment_status = 1;
                } else {
                    $payable_amount = $basic_setting->advance_payment;
                    $order->paidAmount = $basic_setting->advance_payment;
                    $order->due_amount = $order->total - $basic_setting->advance_payment;
                    $order->advance_payment_amount = $basic_setting->advance_payment;
                    $order->advance_payment_status = 1;
                }
            } else {
                $payable_amount = $order->total;
                $order->paidAmount = $order->total;
                $order->due_amount = 0;
            }
            $order->update();
            $codein = $coupon->coupon_code ?? null;
            if (isset($codein)) {
                $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                if (isset($use)) {
                } else {
                    $couponuse = new Usecoupon();
                    $couponuse->user_id = Auth::id();
                    $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                    $couponuse->code = $coupon->coupon_code;
                    $couponuse->date = date('Y-m-d');
                    $couponuse->save();
                }
            }

            $customar = Customer::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'customerName' => auth()->user()->name,
                'customerEmail' => auth()->user()->email,
                'customerPhone' => auth()->user()->phone,
            ]);
            $ordernote = Ordernote::create([
                'order_id' => $order->id,
                'comment' => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                'admin_id' => $superadmin_id->id,
            ]);

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                // Retrieve the specific stock record for the product and size
                $size = Size::where('id', $cart->size_id)->first();
                $product = Product::where('id', $cart->product_id)->first();

                // Check if the size exists and if there's enough stock
                if ($size && $size->stock >= $cart->qty) {
                    // Decrease the size stock by the quantity ordered
                    $size->stock -= $cart->qty;
                    $size->sold += $cart->qty;
                    $size->save(); // Save the updated size stock

                    // Decrease the product's total stock by the quantity ordered
                    $product->total_stock -= $cart->qty;
                    $product->sold += $cart->qty;
                    $product->save(); // Save the updated total stock

                    // Create a new order product record
                    $orp = new Orderproduct();
                    $orp->order_id = $order->id;
                    $orp->product_id = $cart->product_id;
                    $orp->productName = $this->productname($cart->product_id);
                    $orp->color = $cart->color;
                    $orp->size_id = $cart->size_id;
                    $orp->size = $cart->size;
                    $orp->code_id = $cart->code_id;
                    $orp->code = $cart->code;
                    $orp->weight_id = $cart->weight_id;
                    $orp->weight = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price = $cart->price;
                    $orp->qty = $cart->qty;
                    $orp->save();
                } else {
                    // Handle the case where there's not enough stock
                    throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                }
            }

            $paymentCredentials = DB::table('payment_credentials')
                ->where('gateway', 'razorpay')
                ->first()->credentials;
            $paymentCredentials = json_decode($paymentCredentials);

            try {
                // Initialize Razorpay API with credentials
                $razorpay = new Api($paymentCredentials->RAZORPAY_ID_KEY, $paymentCredentials->RAZORPAY_SECRET_KEY);

                // Prepare the options for the Razorpay payment link
                $options = [
                    'amount' => intval($payable_amount) * 100, // amount in paise
                    'currency' => $validated['currency'] ?? 'INR',
                    'description' => 'Payment for your order',
                    'customer' => [
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'contact' => $validated['contact'] ?? null,
                    ],

                    'callback_url' => route('api.razorpay.success'), // Adjust callback URL as needed
                    'callback_method' => 'get',
                    'notes' => [
                        'invoiceID' => $order->invoiceID,
                        'user_id' => Auth::user()->id,
                    ], // Add any custom metadata here
                ];

                // Create Razorpay payment link
                $paymentLink = $razorpay->paymentLink->create($options);

                // Return the payment link URL based on type (web or API)

                $data = [
                    'redirect_url' => $paymentLink['short_url'],
                ];
                return ApiResponse::created(null, $data);

            } catch (\Exception $e) {
                return ApiResponse::error($e->getMessage());

            }

        } else if ('paypal' == $request->payment_type) {

            $superadmin_id = Admin::first();
            $validated['admin_id'] = $superadmin_id->id;
            $validated['invoiceID'] = generateUniqueID(6);
            $validated['subTotal'] = cartSubTotal();
            $validated['orderDate'] = date('Y-m-d');
            $validated['payment_method'] = $validated['payment_type'];

            $order = Order::create($validated);

            $order->web_id = 1;
            $order->user_id = Auth::user()->id;
            $order->order_note = $request->order_none;
            $order->status = "Pending";
            $basic_setting = GeneralSetting::first();

            $coupon = TemporaryData::where('user_id', auth()->user()->id)->first();

            $order->discount = $coupon->discount ?? 0;
            $order->coupon = $coupon->coupon_code ?? null;
            $order->vat = $basic_setting->vat_status == 'ON' ? $basic_setting->vat : 0;
            $order->tax = $basic_setting->tax_status == 'ON' ? $basic_setting->tax : 0;

            $order->total = (cartSubTotal() + $basic_setting->vat + $basic_setting->tax + $validated['delivery_charge']) - ($coupon->discount ?? 0);
            //Advance payment
            if (isset($request->advance_payment) && $request->advance_payment == 1) {
                if ($basic_setting->advance_payment_type == 'percentage') {
                    $advance_payment = ($basic_setting->advance_payment / 100) * $order->total;
                    $payable_amount = $advance_payment;
                    $order->paidAmount = $advance_payment;
                    $order->due_amount = $order->total - $order->paidAmount;
                    $order->advance_payment_amount = $advance_payment;
                    $order->advance_payment_status = 1;

                } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                    $payable_amount = productWiseAdvancePaymentAmount();
                    $order->paidAmount = productWiseAdvancePaymentAmount();
                    $order->due_amount = $order->total - productWiseAdvancePaymentAmount();
                    $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                    $order->advance_payment_status = 1;
                } else {
                    $payable_amount = $basic_setting->advance_payment;
                    $order->paidAmount = $basic_setting->advance_payment;
                    $order->due_amount = $order->total - $basic_setting->advance_payment;
                    $order->advance_payment_amount = $basic_setting->advance_payment;
                    $order->advance_payment_status = 1;
                }
            } else {
                $payable_amount = $order->total;
                $order->paidAmount = $order->total;
                $order->due_amount = 0;
            }
            $order->update();
            $codein = $coupon->coupon_code ?? null;
            if (isset($codein)) {
                $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                if (isset($use)) {
                } else {
                    $couponuse = new Usecoupon();
                    $couponuse->user_id = Auth::id();
                    $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                    $couponuse->code = $coupon->coupon_code;
                    $couponuse->date = date('Y-m-d');
                    $couponuse->save();
                }
            }

            $customar = Customer::create([
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'customerName' => auth()->user()->name,
                'customerEmail' => auth()->user()->email,
                'customerPhone' => auth()->user()->phone,
            ]);
            $ordernote = Ordernote::create([
                'order_id' => $order->id,
                'comment' => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                'admin_id' => $superadmin_id->id,
            ]);

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                // Retrieve the specific stock record for the product and size
                $size = Size::where('id', $cart->size_id)->first();
                $product = Product::where('id', $cart->product_id)->first();

                // Check if the size exists and if there's enough stock
                if ($size && $size->stock >= $cart->qty) {
                    // Decrease the size stock by the quantity ordered
                    $size->stock -= $cart->qty;
                    $size->sold += $cart->qty;
                    $size->save(); // Save the updated size stock

                    // Decrease the product's total stock by the quantity ordered
                    $product->total_stock -= $cart->qty;
                    $product->sold += $cart->qty;
                    $product->save(); // Save the updated total stock

                    // Create a new order product record
                    $orp = new Orderproduct();
                    $orp->order_id = $order->id;
                    $orp->product_id = $cart->product_id;
                    $orp->productName = $this->productname($cart->product_id);
                    $orp->color = $cart->color;
                    $orp->size_id = $cart->size_id;
                    $orp->size = $cart->size;
                    $orp->code_id = $cart->code_id;
                    $orp->code = $cart->code;
                    $orp->weight_id = $cart->weight_id;
                    $orp->weight = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price = $cart->price;
                    $orp->qty = $cart->qty;
                    $orp->save();
                } else {
                    // Handle the case where there's not enough stock
                    throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                }
            }

            $paymentCredentials = DB::table('payment_credentials')
                ->where('gateway', 'razorpay')
                ->first()->credentials;
            $paymentCredentials = json_decode($paymentCredentials);

            try {
                // Retrieve PayPal credentials from the database
                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'paypal')
                    ->first()->credentials;

                $paymentCredentials = json_decode($paymentCredentials);

                $paypal = new PayPalClient();


                $paypal->setApiCredentials([
                    'mode' => $paymentCredentials->is_localhost == 'live' ? 'live' : 'sandbox',
                    $paymentCredentials->is_localhost => [
                        'client_id' => $paymentCredentials->client_id,
                        'client_secret' => $paymentCredentials->secret,
                    ],
                    'payment_action' => 'sale',
                    'currency' => 'USD',
                    'notify_url' => 'your_notify_url', // Your IPN notification URL
                    'locale' => 'en_US',
                    'validate_ssl' => true,
                ]);

                $accessToken = $paypal->getAccessToken();

                $response = $paypal->createOrder([
                    "intent" => "CAPTURE",
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => "USD",
                                "value" => $payable_amount, // Amount to be paid
                            ],
                            "invoiceID" => $order->invoiceID, // Pass order_id or any extra data here
                        ],
                    ],
                    "application_context" => [
                        "return_url" => route('api.paypal.success', ['invoiceID' => $order->invoiceID]),
                        "cancel_url" => route('api.paypal.cancel', ['invoiceID' => $order->invoiceID]),
                    ],
                ]);

                if (isset($response['id'])) {

                    $approvalLink = null;
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            $approvalLink = $link['href'];
                            break;
                        }
                    }

                    // if ($approvalLink) {
                    //     // Return a JSON response with the approval link
                    //     return response()->json([
                    //         'success' => true,
                    //         'message' => 'PayPal order created successfully.',
                    //         'approval_link' => $approvalLink,
                    //         'order_id' => $response['id'],
                    //         'invoice_id' => $order->invoiceID,
                    //     ]);
                    // }
                }

                $data = [
                    'redirect_url' => $approvalLink,
                ];
                return ApiResponse::created(null, $data);

            } catch (\Exception $e) {
                return ApiResponse::error($e->getMessage());

            }

        }

    }

    public function productname($id)
    {
        return Product::where('id', $id)->first()->product_name;
    }
    public function category($id)
    {
        return Product::where('id', $id)->first()->category->category_name;
    }

    public function reOrderPlace(Request $request)
    {

        if ($request->invoiceID != null) {

            $order = Order::where('invoiceID', $request->invoiceID)->first();
            $order->repayment = 1;
            $order->save();
            $payAmount = $order->total - $order->paidAmount;

            if ($request->paymentMethod == 'stripe') {
                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'stripe')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);

                $stripe = new \Stripe\StripeClient($paymentCredentials->secret_key);
                $response = $stripe->checkout->sessions->create([
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => ['name' => 'Amount'],
                                'unit_amount' => ($payAmount * 100),
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('api.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('api.stripe.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
                    'metadata' => [
                        'order' => $order->id,
                        'user_id' => auth()->user()->id,
                        'invoiceID' => $request->invoiceID,

                    ],
                ]);

                if (isset($response->id)) {
                    $data = [
                        'redirect_url' => $response->url,
                    ];

                    return ApiResponse::created(null, $data);
                } else {
                    return ApiResponse::created('Oops, Something Went Wrong.Please try again', null);
                }
            } else if ($request->paymentMethod == 'sslcommerz') {

                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'sslcommerz')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);
                if ($paymentCredentials->is_localhost == 'live') {
                    $payment_url = 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';
                } else {
                    $payment_url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';
                }
                $client = new Client();
                $response = $client->post($payment_url, [
                    'form_params' => [
                        'store_id' => $paymentCredentials->store_id,
                        'store_passwd' => $paymentCredentials->store_password,
                        'total_amount' => $payAmount,
                        'currency' => 'BDT',
                        'tran_id' => $order->invoiceID,
                        'success_url' => route('api.success'),
                        'fail_url' => route('api.fail'),
                        'cancel_url' => route('api.cancel'),
                        'emi_option' => 0,
                        'cus_name' => $order->name,
                        'cus_email' => $order->email,
                        'cus_add1' => $order->address,
                        'cus_city' => $order->city,
                        'shipping_method' => 'NO',
                        'product_name' => 're Payment',
                        'product_category' => 're Payment',
                        'product_profile' => 're Payment',
                        'cus_country' => $order->address,
                        'cus_phone' => $order->phone,
                        'ship_name' => $order->name,
                        'ship_add1' => $order->address,
                        'ship_city' => $order->city,
                        'ship_country' => $order->address,
                    ],
                ]);

                $result = json_decode($response->getBody(), true);
                $data = [
                    'status' => $result['status'],
                    'logo' => $result['storeLogo'],
                    'redirect_url' => $result['GatewayPageURL'],
                ];

                TemporaryData::where('user_id', auth()->user()->id)->delete();
                Cart::where('user_id', auth()->user()->id)->delete();

                if (isset($result['GatewayPageURL']) && $result['GatewayPageURL'] != "") {
                    return ApiResponse::created(null, $data);
                } else {
                    return ApiResponse::created('Semething Went Wrong,Please try again', $data);
                }
            } else if ($request->paymentMethod == 'bkash') {
                $paymentData = [
                    'mode' => '0011', // Mode for tokenized checkout
                    'payerReference' => $order->invoiceID,
                    'intent' => 'sale',
                    'currency' => 'BDT',
                    'amount' => $payAmount,
                    'merchantInvoiceNumber' => $order->invoiceID,
                    'callbackURL' => route('api.bkash-callBack', [
                        'user_id' => $order->user_id,
                        'couponcode' => Session::get('couponcode'),
                        'availablecoupon' => Session::get('availablecoupon'),
                    ]),
                ];

                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'bkash')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);
                if ($paymentCredentials->is_localhost == 'live') {
                    $payment_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/create';
                } else {
                    $payment_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/checkout/create';
                }

                try {
                    $accessToken = $this->getAccessToken();

                    // Make the payment request to bKash
                    $client = new Client();
                    $response = $client->post($payment_url, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Content-Type' => 'application/json',
                            'X-APP-Key' => $paymentCredentials->app_key, // Add X-APP-Key header here
                        ],
                        'body' => json_encode($paymentData),
                    ]);

                    $responseData = json_decode($response->getBody()->getContents(), true);

                    if (isset($responseData['bkashURL'])) {

                        $data = [
                            'redirect_url' => $responseData['bkashURL'],
                        ];
                        return ApiResponse::created(null, $data);
                        // Handle response for Website or API

                    } else {

                        return ApiResponse::error('Unable to create payment. Please try again.');
                    }
                } catch (\Exception $e) {

                    return ApiResponse::error($e->getMessage());
                }
            } else if ($request->paymentMethod == 'razorpay') {

                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'razorpay')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);

                try {
                    // Initialize Razorpay API with credentials
                    $razorpay = new Api($paymentCredentials->RAZORPAY_ID_KEY, $paymentCredentials->RAZORPAY_SECRET_KEY);

                    // Prepare the options for the Razorpay payment link
                    $options = [
                        'amount' => intval($payAmount) * 100, // amount in paise
                        'currency' => $validated['currency'] ?? 'INR',
                        'description' => 'Payment for your order',
                        'customer' => [
                            'name' => $order->name,
                            'email' => $order->email,
                            'contact' => $validated['contact'] ?? null,
                        ],

                        'callback_url' => route('api.razorpay.success'), // Adjust callback URL as needed
                        'callback_method' => 'get',
                        'notes' => [
                            'invoiceID' => $order->invoiceID,
                            'user_id' => Auth::user()->id,
                        ], // Add any custom metadata here
                    ];

                    // Create Razorpay payment link
                    $paymentLink = $razorpay->paymentLink->create($options);

                    // Return the payment link URL based on type (web or API)

                    $data = [
                        'redirect_url' => $paymentLink['short_url'],
                    ];
                    return ApiResponse::created(null, $data);

                } catch (\Exception $e) {
                    return ApiResponse::error($e->getMessage());

                }
            } else {

                $order = Order::where('invoiceID', $request->invoiceID)->first();
                $order->payment_method = 'cash_on_delivery';
                $order->save();
                return ApiResponse::created('Order Create Successfully');

            }

        }
    }

}
