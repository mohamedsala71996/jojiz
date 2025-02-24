<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Admin\Product;
use App\Models\Cart;
use App\Models\Productvariation;
use App\Models\Size;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function list()
    {
        $user = Auth::user();

        if ($user == null) {
            return ApiResponse::onlyMessage('User not authenticated');
        }
        $carts = Cart::where('user_id', auth()->user()->id)->get()->map(function ($cart) {
            return [
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->product_name,
                'product_size' => $cart->size,
                'product_color' => $cart->productvariation->color,
                'qty' => $cart->qty,
                'total' => $cart->total,
                'image' => $cart->productvariation->image,
            ];
        });
        $total = Cart::where('user_id', auth()->user()->id)->sum('total');
        $subTotal = Cart::where('user_id', auth()->user()->id)->sum('total');

        $data = [
            'carts' => $carts,
            'total' => get_amount($total),
            'subTotal' => get_amount($subTotal),
        ];
        return ApiResponse::success('Cart List', $data);
    }

    public function addToCart(Request $request)
    {

        $carts = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->where('color_id', $request->varient_id)->first();
        $product_id = $request->product_id;
        $color_id = $request->varient_id;
        $color = Productvariation::where('id', $request->varient_id)->first()->color;
        $size_id = $request->size_id;
        if ($size_id) {
            $size = Size::where('id', $request->size_id)->first()->size;
            $price = Size::where('id', $request->size_id)->first()->SalePrice;
            $weight_id = $request->weight_id;
            $weight = '';
        } else {
            $size = '';
            $weight_id = $request->weight_id;
            if ($weight_id) {
                $weight = Weight::where('id', $request->weight_id)->first()->weight;
                $price = Weight::where('id', $request->weight_id)->first()->SalePrice;
            } else {
                $weight = '';
            }
        }

        $qty = $request->qty;
        $total = $price * $qty;
        $product = Product::findOrFail($product_id);
        // if ($carts == null) {
            $carts = Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product_id,
                'qty' => $qty,
                'color_id' => $color_id,
                'color' => $color,
                'size' => $size,
                'size_id' => $size_id,
                'weight' => $weight,
                'weight_id' => $weight_id,
                'price' => $price,
                'total' => $total,
                'advance_payment_amount'=> $product->advance_payment_amount
            ]);
        // } else {
        //     $carts->update([
        //         'qty' => $qty,
        //         'color_id' => $color_id,
        //         'color' => $color,
        //         'size' => $size,
        //         'size_id' => $size_id,
        //         'weight' => $weight,
        //         'weight_id' => $weight_id,
        //         'price' => $price,
        //         'total' => $total,
        //     ]);
        // }
        return ApiResponse::success('Item Add To Cart Successfully', $carts);
    }
    public function updateCartItem(Request $request)
    {
        $product_id = $request->product_id;
        $qty = $request->qty;
        $size_id = $request->size_id;
        $varient_id = $request->varient_id;
        $cart = Cart::where('product_id', $product_id)->where('user_id', auth()->user()->id)->first();

        if ($size_id) {
            $size = Size::where('id', $request->size_id)->first()->size;
            $price = Size::where('id', $request->size_id)->first()->SalePrice;
            $weight_id = $request->weight_id;
            $weight = '';
        } else {
            $size = '';
            $weight_id = $request->weight_id;
            if ($weight_id) {
                $weight = Weight::where('id', $request->weight_id)->first()->weight;
                $price = Weight::where('id', $request->weight_id)->first()->SalePrice;
            } else {
                $weight = '';
            }
        }

        $cart->update(array(
            'qty' => $qty,
            'size' => $size,
            'size_id' => $size_id,
            'weight' => $weight,
            'weight_id' => $weight_id,
            'price' => $price,
            'color_id' => $varient_id,
        ));
        $total = ($cart->qty * $cart->price);
        $cart->total = $total;
        $cart->save();

        return ApiResponse::success('Cart Item Updated Successfully', $cart);
    }
    public function removeCartItem($cart_item)
    {

        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $cart_item)->first();
        $cart->delete();
        return ApiResponse::success('Item Removed Successfully');
    }
}
