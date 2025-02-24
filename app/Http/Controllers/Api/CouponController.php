<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Usecoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\TemporaryData;

class CouponController extends Controller
{
    public function list(){
        $coupons = Coupon::where('status','Active')->get();
        $mappedCoupons = $coupons->map(function ($coupon) {
            return [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'amount' => $coupon->amount,
                'coupon_type' => $coupon->coupon_type,
                'categories' => $coupon->categories,
                'date' => $coupon->date,
                'validity' => $coupon->validity,
                'status' => $coupon->status,

            ];
        });
        return ApiResponse::list('Coupon List', $mappedCoupons);
    }

    // public function couponcheck(Request $request)
    // {
    //     $available = Coupon::where('code', $request->coupon_code)->where('validity', '>=', date('Y-m-d'))->first();
    //     $cart_total = Cart::where('user_id',auth()->user()->id)->get()->sum('total');

    //     if (isset($available)) {
    //         $use = Usecoupon::where('user_id', Auth::id())->where('coupon_id', $available->id)->where('code', $request->coupon_code)->first();
    //         if (isset($use)) {
    //             $response = [
    //                 'status' => 'false',
    //                 'discount' => 0,
    //             ];
    //             return ApiResponse::error('Coupon Already Used',null,false);
    //         } else {
    //             $blance = Cart::where('user_id', auth()->user()->id)->get()->sum('total');

    //             if ($available->type == 'Amount') {
    //                 $discount = $available->amount;
    //             } else {
    //                 $discount = intval($blance * ($available->amount / 100));
    //             }

    //             TemporaryData::create([
    //                 'coupon_code'=>$request->coupon_code,
    //                 'discount'=>$discount,
    //                 'user_id'=>auth()->user()->id
    //             ]);

    //             $response = [
    //                 'discount' => $discount,
    //                 'total'=>get_amount($cart_total - $discount),
    //             ];
    //             return ApiResponse::created('Coupon Appiled Successfully',$response);
    //         }
    //     } else {

    //         $response = [
    //             'status' => 'invalid',
    //             'discount' => 0,
    //         ];
    //         return ApiResponse::onlyMessage('Invalid Coupon');
    //     }
    // }
    public function couponcheck(Request $request)
    {
        $available = Coupon::where('code', $request->coupon_code)->where('validity', '>=', date('Y-m-d'))->first();
        $cart_total = Cart::where('user_id',auth()->user()->id)->get()->sum('total');

        if (isset($available)) {
            $use = Usecoupon::where('user_id', Auth::id())->where('coupon_id', $available->id)->where('code', $request->coupon_code)->first();
            if (isset($use)) {
                $response = [
                    'status' => 'false',
                    'discount' => 0,
                ];
                return ApiResponse::error('Coupon Already Used',null,false);
            } else {
                $blance = Cart::where('user_id', auth()->user()->id)->get()->sum('total');
                $discount = 0;
                if ($available->coupon_type == 'global') {
                    if ($available->type == 'Amount') {
                        $discount = $available->amount;
                    } else {
                        $discount = intval($blance * ($available->amount / 100));
                    }
                } elseif ($available->coupon_type == 'category') {
                    // Get all categories for the coupon
                    $eligibleCategories = $available->categories->pluck('id')->toArray();

                    // Calculate discount for category-based items
                    $cartItems = Cart::with('product.category')
                        ->where('user_id', auth()->id())
                        ->get();
                    // dd($eligibleCategories,$cartItems);
                    foreach ($cartItems as $item) {
                        if (in_array($item->product->category_id, $eligibleCategories)) {
                            $itemDiscount = $available->type == 'Amount' ? $available->amount : intval($item->total * ($available->amount / 100));
                            $discount += $itemDiscount;
                        }
                    }
                }



                if ($available->type == 'Amount') {
                    $discount = $available->amount;
                } else {
                    $discount = intval($blance * ($available->amount / 100));
                }

                TemporaryData::create([
                    'coupon_code'=>$request->coupon_code,
                    'discount'=>$discount,
                    'user_id'=>auth()->user()->id
                ]);

                $response = [
                    'discount' => $discount,
                    'total'=>get_amount($cart_total - $discount),
                ];
                return ApiResponse::created('Coupon Appiled Successfully',$response);
            }
        } else {

            $response = [
                'status' => 'invalid',
                'discount' => 0,
            ];
            return ApiResponse::onlyMessage('Invalid Coupon');
        }
    }

    // public function couponcheck(Request $request)
    // {

    //     $available = Coupon::where('code', $request->coupon_code)
    //         ->where('validity', '>=', date('Y-m-d'))
    //         ->first();

    //     if (!$available) {
    //         Session::forget('couponcode');
    //         Session::forget('availablecoupon');
    //         $response = [
    //             'status' => 'invalid',
    //             'discount' => 0,
    //         ];
    //         return response()->json($response, 200);
    //     }

    //     $use = Usecoupon::where('user_id', Auth::id())
    //         ->where('coupon_id', $available->id)
    //         ->where('code', $request->coupon_code)
    //         ->first();

    //     if ($use) {
    //         $response = [
    //             'status' => 'false',
    //             'discount' => 0,
    //         ];
    //         return response()->json($response, 200);
    //     }

    //     // Calculate discount based on coupon type
    //     $blance = Cart::where('user_id', auth()->user()->id)->get()->sum('total');
    //     $discount = 0;

    //     if ($available->coupon_type == 'global') {
    //         if ($available->type == 'Amount') {
    //             $discount = $available->amount;
    //         } else {
    //             $discount = intval($blance * ($available->amount / 100));
    //         }
    //     } elseif ($available->coupon_type == 'category') {
    //         // Get all categories for the coupon
    //         $eligibleCategories = $available->categories->pluck('id')->toArray();

    //         // Calculate discount for category-based items
    //         $cartItems = Cart::with('product.category')
    //             ->where('user_id', auth()->id())
    //             ->get();
    //         // dd($eligibleCategories,$cartItems);
    //         foreach ($cartItems as $item) {
    //             if (in_array($item->product->category_id, $eligibleCategories)) {
    //                 $itemDiscount = $available->type == 'Amount' ? $available->amount : intval($item->total * ($available->amount / 100));
    //                 $discount += $itemDiscount;
    //             }
    //         }
    //     }

    //     // If no discount applies for category coupons
    //     if ($discount <= 0) {
    //         $response = [
    //             'status' => 'invalid',
    //             'discount' => 0,
    //         ];
    //         return response()->json($response, 200);
    //     }

    //     // Save coupon data in session
    //     Session::put('couponcode', $request->coupon_code);
    //     Session::put('availablecoupon', $available);
    //     Session::put('discount', $discount);

    //     $response = [
    //         'status' => 'true',
    //         'discount' => $discount,
    //     ];
    //     return response()->json($response, 200);
    // }
}
