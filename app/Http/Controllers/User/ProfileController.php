<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Arr;
use App\Models\Orderproduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('user.pages.profile');
    }

    public function profileEdit($id)
    {
        return view('user.pages.profile-edit');
    }
    public function profileUpdate(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'nullable',
            'birthday' => 'nullable',
            'email' => 'required|email',
            'phone' => 'nullable',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $user = auth()->user();

        $user->update($validated);

        if ($request->hasFile('image')) {

            $path = 'frontend/images/user/';
            imageUploaded($request,$path,$user);
        }

        Toastr::success(__('frontend.Profile Updated Successfully'));

        return back();
    }
    public function passwordEdit($id)
    {
        return view('user.pages.password-edit');
    }
    public function passwordUpdate(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ])->validate();

        $user = auth()->user();

        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            Toastr::error(__("frontend.Current password didn't match"));
            return back();
        }
        try {
            Auth::user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        } catch (Exception $e) {
            return "Opps! Something went wrong. Please try again.";
        }
        Toastr::success(__("frontend.Password Updated Successfully"));

        return back();
    }
    public function addressBook()
    {
        return view('user.pages.address-book');
    }

    public function storeAddressBook(Request $request)
    {
        $validated = Validator::make($request->all(), []);
    }
    public function editAddressBook()
    {
        return view('user.pages.edit-address-book');
    }

    public function cancellation()
    {
        return view('user.pages.cancellation');
    }
    public function myOrder()
    {
        $orders = Order::with('orderproducts')->where('user_id', auth()->user()->id)->latest('id')->get();
        return view('user.pages.my-order', compact('orders'));
    }
    public function mywishlist()
    {
        $user_id = auth()->user()->id;
        $wishlists = Wishlist::where('user_id', $user_id)->get();

        return view('user.pages.mywishlist', compact('wishlists'));
    }
    public function trackOrder(Request $request)
    {
        if (isset($request->invoiceID)) {
            $order = Order::with('couriers')->where('invoiceID', $request->invoiceID)->first();
            return view('user.pages.track-order', ['order' => $order]);
        } else {
            return view('user.pages.track-order');
        }
    }
    public function paymentOption()
    {
        return view('user.pages.payment-option');
    }
}
