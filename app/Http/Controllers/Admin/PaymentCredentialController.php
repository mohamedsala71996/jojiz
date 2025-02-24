<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin\PaymentCredential;
use Intervention\Image\Facades\Image;

class PaymentCredentialController extends Controller
{
    public function sslcommerzIndex()
    {
        $allPaymentCredentials = DB::table('payment_credentials')->where('gateway', 'sslcommerz')->first();
        $paymentCredentials = json_decode($allPaymentCredentials->credentials);
        $image = $allPaymentCredentials->image;

        return view('admin.pages.Payment-credentials.sslcommerz.index', compact('paymentCredentials','image','allPaymentCredentials'));
    }
    public function sslcommerzUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'credentials.store_id' => 'required|string|max:255',
            'credentials.store_password' => 'required|string|max:255',
            'credentials.is_localhost' => 'required',
            'image' => 'nullable',
        ]);
        $validatedData['credentials']['currency'] = 'BDT';
        $paymentCredentials = PaymentCredential::where('gateway', 'sslcommerz')->first();
        $paymentCredentials->credentials = ($validatedData['credentials']);
        $paymentCredentials->status = $request->status;

        $paymentCredentials->save();

        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/payment/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            if($paymentCredentials->image){
                unlink($paymentCredentials->image);  // delete old photo before uploading new one.  // backend/images/
            }
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $paymentCredentials->image = 'public/' . $new_photo_location;
            $paymentCredentials->save();
        }

        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }
    public function stripeIndex()
    {
        $allPaymentCredentials = DB::table('payment_credentials')->where('gateway', 'stripe')->first();
        $paymentCredentials = json_decode($allPaymentCredentials->credentials);
        $image = $allPaymentCredentials->image;

        return view('admin.pages.Payment-credentials.stripe.index', compact('paymentCredentials','image','allPaymentCredentials'));
    }
    public function stripeUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'credentials.publishable_key' => 'required|string',
            'credentials.secret_key' => 'required|string',
            'credentials.is_localhost' => 'required',
            'image' => 'nullable',
        ]);
        $validatedData['credentials']['currency'] = 'BDT';
        $paymentCredentials = PaymentCredential::where('gateway', 'stripe')->first();
        $paymentCredentials->credentials = ($validatedData['credentials']);
        $paymentCredentials->status = $request->status;
        $paymentCredentials->save();

        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/payment/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            if($paymentCredentials->image){
                unlink($paymentCredentials->image);
            }
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $paymentCredentials->image = 'public/' . $new_photo_location;

            $paymentCredentials->save();
        }

        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }
    public function paypalIndex()
    {
        $allPaymentCredentials = DB::table('payment_credentials')->where('gateway', 'paypal')->first();
        $paymentCredentials = json_decode($allPaymentCredentials->credentials);
        $image = $allPaymentCredentials->image;

        return view('admin.pages.Payment-credentials.paypal.index', compact('paymentCredentials','image','allPaymentCredentials'));
    }
    public function paypalUpdate(Request $request)
    {

        $validatedData = $request->validate([
            'credentials.client_id' => 'required|string',
            'credentials.secret' => 'required|string',
            'credentials.is_localhost' => 'required',
            'image' => 'nullable',
        ]);
        $validatedData['credentials']['currency'] = 'BDT';
        $paymentCredentials = PaymentCredential::where('gateway', 'paypal')->first();
        $paymentCredentials->credentials = ($validatedData['credentials']);
        $paymentCredentials->status = $request->status;
        $paymentCredentials->save();

        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/payment/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            if($paymentCredentials->image){
                unlink($paymentCredentials->image);
            }
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $paymentCredentials->image = 'public/' . $new_photo_location;

            $paymentCredentials->save();
        }

        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }

    public function bkashIndex()
    {
        $allPaymentCredentials = DB::table('payment_credentials')->where('gateway', 'bkash')->first();
        $paymentCredentials = json_decode($allPaymentCredentials->credentials);
        $image = $allPaymentCredentials->image;
        return view('admin.pages.Payment-credentials.bkash.index', compact('paymentCredentials','image','allPaymentCredentials'));
    }
    public function bkashUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'credentials.app_key' => 'required|string',
            'credentials.app_secret' => 'required|string',
            'credentials.username' => 'required|string',
            'credentials.password' => 'required|string',
            'credentials.is_localhost' => 'required',
            'image' => 'nullable',
        ]);
        $validatedData['credentials']['currency'] = 'BDT';
        $paymentCredentials = PaymentCredential::where('gateway', 'bkash')->first();
        $paymentCredentials->credentials = ($validatedData['credentials']);
        $paymentCredentials->status = $request->status;
        $paymentCredentials->save();

        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/payment/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            if($paymentCredentials->image){
                unlink($paymentCredentials->image);  // delete old photo before uploading new one.  // backend/images/
            }
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $paymentCredentials->image = 'public/' . $new_photo_location;

            $paymentCredentials->save();
        }
        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }
    public function razorpayIndex()
    {
        $allPaymentCredentials = DB::table('payment_credentials')->where('gateway', 'razorpay')->first();
        $paymentCredentials = json_decode($allPaymentCredentials->credentials);
        $image = $allPaymentCredentials->image;
        return view('admin.pages.Payment-credentials.razorpay.index', compact('paymentCredentials','image','allPaymentCredentials'));
    }
    public function razorpayUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'credentials.RAZORPAY_ID_KEY' => 'required|string',
            'credentials.RAZORPAY_SECRET_KEY' => 'required|string',
            'credentials.is_localhost' => 'required',
            'image' => 'nullable',
        ]);
        $validatedData['credentials']['currency'] = 'INR';
        $paymentCredentials = PaymentCredential::where('gateway', 'razorpay')->first();
        $paymentCredentials->credentials = ($validatedData['credentials']);
        $paymentCredentials->status = $request->status;
        $paymentCredentials->save();

        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/payment/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            if($paymentCredentials->image){
                unlink($paymentCredentials->image);  // delete old photo before uploading new one.  // backend/images/
            }
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $paymentCredentials->image = 'public/' . $new_photo_location;

            $paymentCredentials->save();
        }
        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }
    public function cashOnDeliveryIndex()
    {
        $allPaymentCredentials = DB::table('payment_credentials')->where('gateway', 'cash_on_delivary')->first();
        $paymentCredentials = json_decode($allPaymentCredentials->credentials);
        $image = $allPaymentCredentials->image;
        return view('admin.pages.Payment-credentials.cache-on-delivery.index', compact('paymentCredentials','image','allPaymentCredentials'));
    }
    public function cashOnDeliveryUpdate(Request $request)
    {

        $paymentCredentials = PaymentCredential::where('gateway', 'cash_on_delivary')->first();

        $paymentCredentials->status = $request->status;
        $paymentCredentials->save();

        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/payment/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            if($paymentCredentials->image){
                unlink($paymentCredentials->image);  // delete old photo before uploading new one.  // backend/images/
            }
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $paymentCredentials->image = 'public/' . $new_photo_location;

            $paymentCredentials->save();
        }
        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }
}
