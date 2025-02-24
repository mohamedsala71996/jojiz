<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\DelivaryCharge;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Ordernote;
use App\Models\Orderproduct;
use App\Models\OtherDeliveryCharge;
use App\Models\Size;
use App\Models\Usecoupon;
use App\Models\User\Notification;
use App\Notifications\InvoiceMail;
use App\Traits\PaymentGateway\Bkash;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    use Bkash;
    public function checkoutPage()
    {
        $setting               = GeneralSetting::first();
        $carts                 = Cart::where('user_id', auth()->user()->id)->get();
        $stripe                = DB::table('payment_credentials')->where('gateway', 'stripe')->first();
        $sslcommerz            = DB::table('payment_credentials')->where('gateway', 'sslcommerz')->first();
        $bkash                 = DB::table('payment_credentials')->where('gateway', 'bkash')->first();
        $razorpay              = DB::table('payment_credentials')->where('gateway', 'razorpay')->first();
        $cash_on_delivary      = DB::table('payment_credentials')->where('gateway', 'cash_on_delivary')->first();
        $paypal                = DB::table('payment_credentials')->where('gateway', 'paypal')->first();
        $delivaryCharges       = DelivaryCharge::get();
        $other_delivery_charge = OtherDeliveryCharge::first();

        return view('user.pages.checkout', compact(
            'setting',
            'carts',
            'stripe',
            'razorpay',
            'sslcommerz',
            'bkash',
            'delivaryCharges',
            'cash_on_delivary',
            'other_delivery_charge',
            'paypal'
        ));
    }
    public function orderPlace(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'name'                      => 'required|string',
            'phone'                     => 'required|string',
            'address'                   => 'required|string',
            'email'                     => 'nullable|string',
            'city'                      => 'nullable|string',
            'addressWiseShippingCharge' => 'nullable',
            'country'                   => 'nullable|string',
            'state'                     => 'nullable|string',
            'zip_code'                  => 'nullable|string',
            'payment'                   => 'required',
            'delivery_option'           => 'required',
            'delivery_option_type'      => 'nullable',
        ])->validate();
        $validated['email']    = $validated['email'] ?? auth()->user()->email;
        $validated['country']  = $validated['country'] ?? $validated['address'];
        $validated['state']    = $validated['state'] ?? $validated['address'];
        $validated['zip_code'] = $validated['zip_code'] ?? $validated['address'];
        $validated['city']     = $validated['city'] ?? $validated['address'];
        $basic_setting         = GeneralSetting::first();
        $other_delivery_charge = OtherDeliveryCharge::first();
        $countcart             = Cart::where('user_id', auth()->user()->id)->get();

        if (count($countcart) > 0) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
            foreach ($carts as $cart) {
                // Retrieve the specific product and size record
                $product = Product::where('id', $cart->product_id)->first();

                $size = Size::where('id', $cart->size_id)->first();

                if (! $size || $size->stock < $cart->qty || ! $product || $product->total_stock < $cart->qty) {
                    // Handle the case where there's not enough stock

                    Toastr::error('Product Name: ' . $product->product_name . '<br /> Size: ' . $size->size . '<br /> ' . 'Stock Out');
                    return redirect()->back();
                }
            }

            if ($request->payment == 'sslcommerz') {

                $post_data             = [];
                $superadmin_id         = Admin::first();
                $validated['admin_id'] = $superadmin_id->id;

                $validated['invoiceID']      = generateUniqueID(6);
                $validated['subTotal']       = cartSubTotal();
                $validated['orderDate']      = date('Y-m-d');
                $validated['transaction_id'] = $validated['invoiceID'];
                $validated['payment_method'] = $validated['payment'];

                # CUSTOMER INFORMATION
                $post_data['cus_name']     = $validated['name'];
                $post_data['cus_email']    = $validated['email'];
                $post_data['cus_phone']    = $validated['phone'];
                $post_data['cus_add']      = $validated['address'];
                $post_data['cus_country']  = $validated['country'];
                $post_data['cus_city']     = $validated['city'];
                $post_data['cus_state']    = $validated['state'];
                $post_data['cus_postcode'] = $validated['zip_code'];
                $post_data['tran_id']      = $validated['invoiceID'];

                # SHIPMENT INFORMATION
                $post_data['ship_name']     = "Store Test";
                $post_data['ship_add1']     = "Dhaka";
                $post_data['ship_add2']     = "Dhaka";
                $post_data['ship_city']     = "Dhaka";
                $post_data['ship_state']    = "Dhaka";
                $post_data['ship_postcode'] = "1000";
                $post_data['ship_phone']    = "";
                $post_data['ship_country']  = "Bangladesh";

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;
                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }
                $order->discount       = $request->discount;
                $order->coupon         = Session::get('couponcode');
                $order->vat            = $request->vat;
                $order->tax            = $request->tax;
                $order->payment_status = "due";
                $order->total          = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;
                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $payable_amount                = $advance_payment;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $payable_amount                = productWiseAdvancePaymentAmount();
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $payable_amount                = $basic_setting->advance_payment;
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $payable_amount    = $order->total;
                    $order->paidAmount = $order->total;
                    $order->due_amount = 0;
                }
                $order->update();

                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }

                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);

                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    // Retrieve the specific stock record for the product and size
                    $size    = Size::where('id', $cart->size_id)->first();
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
                        $orp                      = new Orderproduct();
                        $orp->order_id            = $order->id;
                        $orp->product_id          = $cart->product_id;
                        $orp->productName         = $this->productname($cart->product_id);
                        $orp->color               = $cart->color;
                        $orp->size_id             = $cart->size_id;
                        $orp->size                = $cart->size;
                        $orp->code_id             = $cart->code_id;
                        $orp->code                = $cart->code;
                        $orp->weight_id           = $cart->weight_id;
                        $orp->weight              = $cart->weight;
                        $orp->productvariation_id = $cart->color_id;
                        $orp->price               = $cart->price;
                        $orp->qty                 = $cart->qty;
                        $orp->save();
                    } else {
                        // Handle the case where there's not enough stock
                        throw new \Exception('Insufficient stock for product size ID: ' . $cart->size);
                    }
                }

                Cart::where('user_id', auth()->user()->id)->delete();
                Session::forget('couponcode');
                Session::forget('availablecoupon');

                $post_data['total_amount'] = intval($payable_amount);
                $post_data['currency']     = "BDT";

                $post_data['shipping_method']  = "NO";
                $post_data['product_name']     = "Computer";
                $post_data['product_category'] = "Goods";
                $post_data['product_profile']  = "physical-goods";

                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'sslcommerz')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);
                if ($paymentCredentials->is_localhost == 'live') {
                    $payment_url = 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';
                } else {
                    $payment_url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';
                }

                $client   = new Client();
                $response = $client->post($payment_url, [
                    'form_params' => [
                        'store_id'         => $paymentCredentials->store_id,
                        'store_passwd'     => $paymentCredentials->store_password,
                        'total_amount'     => $order->total,
                        'currency'         => 'BDT',
                        'tran_id'          => $validated['invoiceID'],
                        'success_url'      => route('sslcommerz.success'),
                        'fail_url'         => route('sslcommerz.fail'),
                        'cancel_url'       => route('sslcommerz.cancel'),
                        'emi_option'       => 0,
                        'cus_name'         => $post_data['cus_name'],
                        'cus_email'        => $post_data['cus_email'],
                        'cus_add1'         => $post_data['cus_add'],
                        'cus_city'         => $post_data['cus_city'],
                        'shipping_method'  => 'NO',
                        'product_name'     => $this->productname($cart->product_id),
                        'product_category' => $this->category($cart->product_id),
                        'product_profile'  => $this->category($cart->product_id),
                        'cus_country'      => $validated['address'],
                        'cus_phone'        => $validated['phone'],
                        'ship_name'        => $validated['name'],
                        'ship_add1'        => $post_data['cus_add'],
                        'ship_city'        => $post_data['cus_city'],
                        'ship_country'     => $validated['address'],
                        'metadata'         => $order,
                    ],
                ]);

                $responseBody = json_decode($response->getBody());

                if ($responseBody->status == 'SUCCESS') {
                    return redirect()->away($responseBody->GatewayPageURL);
                } else {
                    return redirect()->route('sslcommerz.fail');
                }
            } else if ($request->payment == 'stripe') {

                $superadmin_id               = Admin::first();
                $validated['admin_id']       = $superadmin_id->id;
                $validated['invoiceID']      = generateUniqueID(6);
                $validated['subTotal']       = cartSubTotal();
                $validated['orderDate']      = date('Y-m-d');
                $validated['payment_method'] = $validated['payment'];

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;

                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }

                $order->discount       = $request->discount;
                $order->coupon         = Session::get('couponcode');
                $order->status         = "Pending";
                $order->payment_status = "due";
                $order->vat            = $request->vat;
                $order->tax            = $request->tax;
                $order->total          = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;
                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $payable_amount                = $advance_payment;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $payable_amount                = productWiseAdvancePaymentAmount();
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $payable_amount                = $basic_setting->advance_payment;
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $payable_amount    = $order->total;
                    $order->paidAmount = $order->total;
                    $order->due_amount = 0;
                }
                $order->update();
                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }

                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);

                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    // Retrieve the specific stock record for the product and size
                    $size    = Size::where('id', $cart->size_id)->first();
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
                        $orp                      = new Orderproduct();
                        $orp->order_id            = $order->id;
                        $orp->product_id          = $cart->product_id;
                        $orp->productName         = $this->productname($cart->product_id);
                        $orp->color               = $cart->color;
                        $orp->size_id             = $cart->size_id;
                        $orp->size                = $cart->size;
                        $orp->code_id             = $cart->code_id;
                        $orp->code                = $cart->code;
                        $orp->weight_id           = $cart->weight_id;
                        $orp->weight              = $cart->weight;
                        $orp->productvariation_id = $cart->color_id;
                        $orp->price               = $cart->price;
                        $orp->qty                 = $cart->qty;
                        $orp->save();
                    } else {
                        // Handle the case where there's not enough stock
                        throw new \Exception('Insufficient stock for product size ID: ' . $cart->size_id);
                    }
                }

                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'stripe')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);

                $stripe   = new \Stripe\StripeClient($paymentCredentials->secret_key);
                $response = $stripe->checkout->sessions->create([
                    'line_items'  => [
                        [
                            'price_data' => [
                                'currency'     => 'usd',
                                'product_data' => ['name' => 'Amount'],
                                'unit_amount'  => (intval($payable_amount) * 100),

                            ],
                            'quantity'   => 1,
                        ],
                    ],
                    'mode'        => 'payment',
                    'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'  => route('stripe.cancel') . '?session_id={CHECKOUT_SESSION_ID}',

                ]);

                if (isset($response->id) && $response->id != '') {
                    Session::put('order', $order);
                    return redirect($response->url);
                } else {
                    Session::put('order', $order);
                    return redirect()->route('stripe.cancel');
                }
            } else if ($request->payment == 'bkash') {

                $superadmin_id               = Admin::first();
                $validated['admin_id']       = $superadmin_id->id;
                $validated['invoiceID']      = generateUniqueID(6);
                $validated['subTotal']       = cartSubTotal();
                $validated['orderDate']      = date('Y-m-d');
                $validated['payment_method'] = $request->payment;

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;
                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }

                $order->discount = $request->discount;
                $order->coupon   = Session::get('couponcode');
                $order->vat      = $request->vat;
                $order->tax      = $request->tax;
                $order->total    = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;
                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $payable_amount                = $advance_payment;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $payable_amount                = productWiseAdvancePaymentAmount();
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $payable_amount                = $basic_setting->advance_payment;
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $payable_amount    = $order->total;
                    $order->paidAmount = $order->total;
                    $order->due_amount = 0;
                }
                $order->update();
                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }
                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);

                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    $orp             = new Orderproduct();
                    $orp->order_id   = $order->id;
                    $orp->product_id = $cart->product_id;
                    // $orp->productSku = $this->productsku($cart->product_id);
                    $orp->productName         = $this->productname($cart->product_id);
                    $orp->color               = $cart->color;
                    $orp->size_id             = $cart->size_id;
                    $orp->size                = $cart->size;
                    $orp->code_id             = $cart->code_id;
                    $orp->code                = $cart->code;
                    $orp->weight_id           = $cart->weight_id;
                    $orp->weight              = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price               = $cart->price;
                    $orp->qty                 = $cart->qty;
                    $orp->save();
                }

                $paymentData = [
                    'mode'                  => '0011', // Mode for tokenized checkout
                    'payerReference'        => $order->invoiceID,
                    'intent'                => 'sale',
                    'currency'              => 'BDT',
                    // 'amount' =>  $order->total,
                    'amount'                => intval($payable_amount),
                    'merchantInvoiceNumber' => $order->invoiceID,
                    'callbackURL'           => route('web-bkash-callBack', [
                        'order_id' => $order->id,
                    ]), // Ensure this route exists and is accessible
                ];
                Session::put('order_id', $order->id);
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
                    $client   = new Client();
                    $response = $client->post($payment_url, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Content-Type'  => 'application/json',
                            'X-APP-Key'     => $paymentCredentials->app_key, // Add X-APP-Key header here
                        ],
                        'body'    => json_encode($paymentData),
                    ]);

                    $responseData = json_decode($response->getBody()->getContents(), true);

                    if (isset($responseData['bkashURL'])) {
                        return redirect($responseData['bkashURL']);
                        // Handle response for Website or API

                    } else {
                        Toastr::error('Unable to create payment. Please try again.');
                    }
                } catch (\Exception $e) {

                    Toastr::error($e->getMessage());
                }
            } else if ($request->payment == 'razorpay') {

                $superadmin_id               = Admin::first();
                $validated['admin_id']       = $superadmin_id->id;
                $validated['invoiceID']      = generateUniqueID(6);
                $validated['subTotal']       = cartSubTotal();
                $validated['orderDate']      = date('Y-m-d');
                $validated['payment_method'] = $request->payment;

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;
                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }

                $order->discount = $request->discount;
                $order->coupon   = Session::get('couponcode');
                $order->vat      = $request->vat;
                $order->tax      = $request->tax;
                $order->total    = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;
                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $payable_amount                = $advance_payment;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $payable_amount                = productWiseAdvancePaymentAmount();
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $payable_amount                = $basic_setting->advance_payment;
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $payable_amount    = $order->total;
                    $order->paidAmount = $order->total;
                    $order->due_amount = 0;
                }
                $order->update();
                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }
                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);

                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    $orp             = new Orderproduct();
                    $orp->order_id   = $order->id;
                    $orp->product_id = $cart->product_id;
                    // $orp->productSku = $this->productsku($cart->product_id);
                    $orp->productName         = $this->productname($cart->product_id);
                    $orp->color               = $cart->color;
                    $orp->size_id             = $cart->size_id;
                    $orp->size                = $cart->size;
                    $orp->code_id             = $cart->code_id;
                    $orp->code                = $cart->code;
                    $orp->weight_id           = $cart->weight_id;
                    $orp->weight              = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price               = $cart->price;
                    $orp->qty                 = $cart->qty;
                    $orp->save();
                }

                Session::put('order_id', $order->id);
                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'razorpay')
                    ->first()->credentials;
                $paymentCredentials = json_decode($paymentCredentials);

                try {
                    // Initialize Razorpay API with credentials
                    $razorpay = new Api($paymentCredentials->RAZORPAY_ID_KEY, $paymentCredentials->RAZORPAY_SECRET_KEY);

                    // Prepare the options for the Razorpay payment link
                    $options = [
                        'amount'          => intval($payable_amount) * 100, // amount in paise
                        'currency'        => $validated['currency'] ?? 'INR',
                        'description'     => 'Payment for your order',
                        'customer'        => [
                            'name'    => $validated['name'],
                            'email'   => $validated['email'],
                            'contact' => $validated['contact'] ?? null,
                        ],

                        'callback_url'    => url('/payment-success'), // Adjust callback URL as needed
                        'callback_method' => 'get',
                        'notes'           => [
                            'invoiceID' => $order->invoiceID,
                            'user_id'   => Auth::user()->id,
                        ], // Add any custom metadata here
                    ];

                    // Create Razorpay payment link
                    $paymentLink = $razorpay->paymentLink->create($options);

                    return redirect($paymentLink['short_url']); // Redirect to payment link for web

                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => $e->getMessage(),
                    ], 500);
                }
            } else if ($request->payment == 'orangeMoney') {
                $superadmin_id               = Admin::first();
                $validated['admin_id']       = $superadmin_id->id;
                $validated['invoiceID']      = generateUniqueID(6);
                $validated['subTotal']       = cartSubTotal();
                $validated['orderDate']      = date('Y-m-d');
                $validated['payment_method'] = $request->payment;

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;
                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }

                $order->discount = $request->discount;
                $order->coupon   = Session::get('couponcode');
                $order->vat      = $request->vat;
                $order->tax      = $request->tax;
                $order->total    = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;
                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $payable_amount                = $advance_payment;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $payable_amount                = productWiseAdvancePaymentAmount();
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $payable_amount                = $basic_setting->advance_payment;
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $payable_amount    = $order->total;
                    $order->paidAmount = $order->total;
                    $order->due_amount = 0;
                }
                $order->update();
                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }
                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);

                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    $orp             = new Orderproduct();
                    $orp->order_id   = $order->id;
                    $orp->product_id = $cart->product_id;
                    // $orp->productSku = $this->productsku($cart->product_id);
                    $orp->productName         = $this->productname($cart->product_id);
                    $orp->color               = $cart->color;
                    $orp->size_id             = $cart->size_id;
                    $orp->size                = $cart->size;
                    $orp->code_id             = $cart->code_id;
                    $orp->code                = $cart->code;
                    $orp->weight_id           = $cart->weight_id;
                    $orp->weight              = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price               = $cart->price;
                    $orp->qty                 = $cart->qty;
                    $orp->save();
                }

                // Session::put('order_id', $order->id);
                // $paymentCredentials = DB::table('payment_credentials')
                //     ->where('gateway', 'razorpay')
                //     ->first()->credentials;
                // $paymentCredentials = json_decode($paymentCredentials);

                try {
                    $client   = new \GuzzleHttp\Client();
                    $response = $client->post('https://api.orange.com/orange-money-webpay/payment', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $this->getOrangeAccessToken(),
                            'Content-Type'  => 'application/json',
                        ],
                        'json'    => [
                            'merchant_name' => 'Shopaholic',
                            'order_id'      => $order->invoiceID,
                            'amount'        => $payable_amount,
                            'currency'      => 'XOF',
                            'return_url'    => "{{route('orange.money.callback'}}",
                        ],
                    ]);

                    $result = json_decode($response->getBody()->getContents(), true);

                    return redirect($result['payment_url']); // Redirect to Orange Money payment pa

                } catch (\Exception $e) {

                    return response()->json([
                        'success' => false,
                        'message' => $e->getMessage(),
                    ], 500);
                }
            } else if ($request->payment == 'paypal') {
                $superadmin_id               = Admin::first();
                $validated['admin_id']       = $superadmin_id->id;
                $validated['invoiceID']      = generateUniqueID(6);
                $validated['subTotal']       = cartSubTotal();
                $validated['orderDate']      = date('Y-m-d');
                $validated['payment_method'] = $request->payment;

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;
                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }

                $order->discount = $request->discount;
                $order->coupon   = Session::get('couponcode');
                $order->vat      = $request->vat;
                $order->tax      = $request->tax;
                $order->total    = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;
                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $payable_amount                = $advance_payment;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $payable_amount                = productWiseAdvancePaymentAmount();
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $payable_amount                = $basic_setting->advance_payment;
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $payable_amount    = $order->total;
                    $order->paidAmount = $order->total;
                    $order->due_amount = 0;
                }
                $order->update();
                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }
                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);

                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    $orp             = new Orderproduct();
                    $orp->order_id   = $order->id;
                    $orp->product_id = $cart->product_id;
                    // $orp->productSku = $this->productsku($cart->product_id);
                    $orp->productName         = $this->productname($cart->product_id);
                    $orp->color               = $cart->color;
                    $orp->size_id             = $cart->size_id;
                    $orp->size                = $cart->size;
                    $orp->code_id             = $cart->code_id;
                    $orp->code                = $cart->code;
                    $orp->weight_id           = $cart->weight_id;
                    $orp->weight              = $cart->weight;
                    $orp->productvariation_id = $cart->color_id;
                    $orp->price               = $cart->price;
                    $orp->qty                 = $cart->qty;
                    $orp->save();
                }

                // Retrieve PayPal credentials from the database
                $paymentCredentials = DB::table('payment_credentials')
                    ->where('gateway', 'paypal')
                    ->first()->credentials;

                $paymentCredentials = json_decode($paymentCredentials);

                $paypal = new PayPalClient();

                // Set API credentials dynamically
                $paypal->setApiCredentials([
                    'mode'                            => $paymentCredentials->is_localhost == 'live' ? 'live' : 'sandbox',
                    $paymentCredentials->is_localhost => [
                        'client_id'     => $paymentCredentials->client_id,
                        'client_secret' => $paymentCredentials->secret,
                    ],
                    'payment_action'                  => 'sale',
                    'currency'                        => 'USD',
                    'notify_url'                      => 'your_notify_url', // Your IPN notification URL
                    'locale'                          => 'en_US',
                    'validate_ssl'                    => true,
                ]);

                $accessToken = $paypal->getAccessToken();

                // Create PayPal order
                $response = $paypal->createOrder([
                    "intent"              => "CAPTURE",
                    "purchase_units"      => [
                        [
                            "amount"    => [
                                "currency_code" => "USD",
                                "value"         => $payable_amount, // Amount to be paid
                            ],
                            "invoiceID" => $order->invoiceID, // Pass order_id or any extra data here
                        ],
                    ],
                    "application_context" => [

                        "return_url" => route('paypal.success', ['invoiceID' => $order->invoiceID]),
                        "cancel_url" => route('paypal.cancel', ['invoiceID' => $order->invoiceID]),
                    ],
                ]);

                if (isset($response['id'])) {
                    // Redirect to PayPal approval link
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            return redirect($link['href']);
                        }
                    }
                } else {
                    return redirect()->route('paypal.cancel');
                }

            } else {

                $superadmin_id          = Admin::first();
                $validated['admin_id']  = $superadmin_id->id;
                $validated['invoiceID'] = generateUniqueID(6);
                // $validated['invoiceID'] =(uniqid();
                $validated['subTotal'] = cartSubTotal();

                $validated['orderDate']      = date('Y-m-d');
                $validated['payment_method'] = $validated['payment'];

                $order = Order::create($validated);

                $order->web_id     = 1;
                $order->user_id    = Auth::user()->id;
                $order->order_note = $request->order_none;
                if (($order->subTotal >= $other_delivery_charge->free_shipping_fee && $other_delivery_charge->free_shipping_status == 1) || ($validated['delivery_option_type'] == 'pick_up_our_place_duration')) {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = 0;
                    } else {
                        $order->shippingCharge = 0;
                    }
                } else {

                    if ($basic_setting->delivery_charge_type == 'address_wise') {
                        $order->shippingCharge = $validated['addressWiseShippingCharge'] + $validated['delivery_option'];
                    } else {
                        $order->shippingCharge = $validated['delivery_option'] + $basic_setting->delivary_charge;
                    }
                }

                $order->discount = $request->discount;
                $order->coupon   = Session::get('couponcode');
                $order->vat      = $request->vat;
                $order->tax      = $request->tax;

                $order->total = (cartSubTotal() + $request->vat + $request->tax + $order->shippingCharge) - $request->discount;

                if (isset($request->advance_payment)) {
                    if ($basic_setting->advance_payment_type == 'percentage') {
                        $advance_payment               = ($basic_setting->advance_payment / 100) * $order->total;
                        $order->paidAmount             = $advance_payment;
                        $order->due_amount             = $order->total - $order->paidAmount;
                        $order->advance_payment_amount = $advance_payment;
                        $order->advance_payment_status = 1;
                    } elseif ($basic_setting->advance_payment_type == 'product_wise') {
                        $order->paidAmount             = productWiseAdvancePaymentAmount();
                        $order->due_amount             = $order->total - productWiseAdvancePaymentAmount();
                        $order->advance_payment_amount = productWiseAdvancePaymentAmount();
                        $order->advance_payment_status = 1;
                    } else {
                        $order->paidAmount             = $basic_setting->advance_payment;
                        $order->due_amount             = $order->total - $basic_setting->advance_payment;
                        $order->advance_payment_amount = $basic_setting->advance_payment;
                        $order->advance_payment_status = 1;
                    }
                } else {
                    $order->paidAmount = 0;
                    $order->due_amount = $order->total;
                }
                $order->update();

                $codein = Session::get('couponcode');
                if (isset($codein)) {
                    $use = Usecoupon::where('user_id', Auth::id())->where('code', $codein)->first();
                    if (isset($use)) {
                    } else {
                        $couponuse            = new Usecoupon();
                        $couponuse->user_id   = Auth::id();
                        $couponuse->coupon_id = Coupon::where('code', $codein)->first()->id;
                        $couponuse->code      = Session::get('couponcode');
                        $couponuse->date      = date('Y-m-d');
                        $couponuse->save();
                    }
                }

                $customar = Customer::create([
                    'order_id'      => $order->id,
                    'user_id'       => auth()->user()->id,
                    'customerName'  => auth()->user()->name,
                    'customerEmail' => auth()->user()->email,
                    'customerPhone' => auth()->user()->phone,
                ]);
                $ordernote = Ordernote::create([
                    'order_id' => $order->id,
                    'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
                    'admin_id' => $superadmin_id->id,
                ]);
                $carts = Cart::where('user_id', auth()->user()->id)->get();

                foreach ($carts as $cart) {
                    // Retrieve the specific stock record for the product and size
                    $size    = Size::where('id', $cart->size_id)->first();
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
                        $orp                      = new Orderproduct();
                        $orp->order_id            = $order->id;
                        $orp->product_id          = $cart->product_id;
                        $orp->productName         = $this->productname($cart->product_id);
                        $orp->color               = $cart->color;
                        $orp->size_id             = $cart->size_id;
                        $orp->size                = $cart->size;
                        $orp->code_id             = $cart->code_id;
                        $orp->code                = $cart->code;
                        $orp->weight_id           = $cart->weight_id;
                        $orp->weight              = $cart->weight;
                        $orp->productvariation_id = $cart->color_id;
                        $orp->price               = $cart->price;
                        $orp->qty                 = $cart->qty;
                        $orp->save();
                    } else {
                        // Handle the case where there's not enough stock
                        throw new \Exception('Insufficient stock for product size ID: ' . $cart->size_id);
                    }
                }

                //For push notification
                sendNotification('Success', 'New Order Arrived');
                Notification::create([
                    'user_id' => auth()->user()->id,
                    'title'   => 'Order Successfull',
                    'type'    => 'order',
                    'invoice' => $order->invoiceID,
                ]);

                $superadmin = Admin::first();
                try {
                    $superadmin->notify(new InvoiceMail($order));
                } catch (Exception $e) {
                    dd($e);
                    // \Log::error('Failed to send email: ' . $e->getMessage());
                }

                Cart::where('user_id', auth()->user()->id)->delete();
                Session::forget('couponcode');
                Session::forget('availablecoupon');
                Toastr::success(__("frontend.Order Place Successfully"));
                return redirect('user/my-order');
            }
        } else {
            Toastr::error('Your Cart Is Empty. Please choose product first then try');
            return redirect()->back();
        }
    }

    private function getOrangeAccessToken()
    {
        // Get an access token from Orange Money
        $client   = new \GuzzleHttp\Client();
        $response = $client->post('https://api.orange.com/oauth/v3/token', [
            'auth'        => ["Ee4vPB1DJvHEBueVyjeexiKSpsGmSUf1", "nWoJAA64V2Pzc029"],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
            'headers'     => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['access_token'];
    }

    public function productname($id)
    {
        return Product::where('id', $id)->first()->product_name;
    }
    public function productsku($id)
    {
        return Product::where('id', $id)->first()->product_sku;
    }
    public function category($id)
    {
        return Product::where('id', $id)->first()->category->category_name;
    }
}
