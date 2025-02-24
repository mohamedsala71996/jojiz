<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Cart;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Weight;
use App\Models\Productvariation;

class CartController extends Controller
{
    public function addToCartPage()
    {
        $carts = Cart::with(['product', 'productVariation'])->where('user_id', auth()->user()->id)->latest('id')->get();
        $qty = Cart::where('user_id', auth()->user()->id)->get()->sum('qty');

        return view('user.pages.cart', compact('carts',));
    }

    public function addToCart(Request $request)
{

    $product_id = $request->product_id;
    $color_id = $request->varient_id;
    $size_id = $request->size_id;
    $weight_id = $request->weight_id;
    $qty = $request->qty;

    // Retrieve the color
    $color = Productvariation::find($color_id)->color ?? '';

    // Initialize variables
    $size = '';
    $price = 0;
    $weight = '';

    // Fetch size details if size_id is provided
    if ($size_id) {
        $sizeModel = Size::find($size_id);
        $size = $sizeModel->size ?? '';
        $price = $sizeModel->SalePrice ?? 0;
    }

    // Fetch weight details if weight_id is provided
    if ($weight_id) {
        $weightModel = Weight::find($weight_id);
        $weight = $weightModel->weight ?? '';
        $price = $weightModel->SalePrice ?? 0;
    }

    // Calculate total price
    $total = $price * $qty;
    $product = Product::findOrFail($product_id);



    // Check if the item already exists in the cart
    $existingCartItem = Cart::where('user_id', auth()->user()->id)
        ->where('product_id', $product_id)
        ->where('size_id', $size_id)
        ->where('weight_id', $weight_id)
        ->first();

    if ($existingCartItem) {
        // Update the existing cart item
        $existingCartItem->update([
            'qty' => $qty,
            'color_id' => $color_id,
            'color' => $color,
            'size' => $size,
            'size_id' => $size_id,
            'weight' => $weight,
            'weight_id' => $weight_id,
            'price' => $price,
            'total' => $total,
        ]);
    } else {
        // Create a new cart item
        Cart::create([
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
    }


    // Return response based on the request type
    if ($request->ajax()) {
        return response()->json([
            'status' => 'success',
            'message' => __('frontend.Item Add To Cart Successfully'),
        ], 200);
    } else {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return redirect()->route('user.cart.add.to.cart.page')->with('carts', $carts);
    }
}

    public function removeCartItem($cart_item)
    {
        Cart::where('user_id', auth()->user()->id)->where('id', $cart_item)->delete();

        Toastr::success(__('frontend.Remove Item from cart'));

        return back();
    }
    public function updateCartItem(Request $request)
    {

        $product_id = $request->product_id;
        $cart_id = $request->cart_id;
        $qty = $request->qty;
        $cart = Cart::where('product_id', $product_id)->where('user_id', auth()->user()->id)->first();

        $cart->update(array(
            'qty' => $qty,
        ));
        $total = ($cart->qty * $cart->price);
        $cart->total = $total;
        $cart->save();
        return response()->json([
            'status' => 'success',
            'total' => $total,
            'message' => __('frontend.Cart Item Updated Successfully'),

        ]);
    }
}
