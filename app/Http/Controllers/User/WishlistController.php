<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlistPage()
    {
        $user_id = auth()->user()->id;
        $wishlists = Wishlist::where('user_id', $user_id)->get();

        return view('user.pages.wishlist', compact('wishlists'));
    }

    public function viewwishlist()
    {
        $user_id = auth()->user()->id;
        $wishlists = Wishlist::where('user_id', $user_id)->get();

        return view('user.pages.wishlistview', compact('wishlists'));
    }
    public function addWishlist(Request $request)
    {

        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $before_added = Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($before_added == null) {
            $productvariation_id = $request->productvariation_id;
            $size_id = $request->size_id;
            $weight_id = $request->weight_id;
            Wishlist::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'productvariation_id' => $productvariation_id,
                'size_id' => $size_id,
                'weight_id' => $weight_id,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => __('frontend.Item Added Successfully in Wishlist'),
            ], 200);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => __('frontend.Already Added in Wishlist'),
            ], 200);
        }
    }
    public function removeWishlist(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = auth()->user()->id;
        $wishlist = Wishlist::where('user_id', $user_id)->where('product_id', $product_id);
        $wishlist->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('frontend.Item Remove Successfully form Wishlist'),
        ], 200);
    }
    public function allRemoveWishlist(Request $request)
    {
        $user_id = auth()->user()->id;
        $wishlist = Wishlist::where('user_id', $user_id);
        $wishlist->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('frontend.All Item Remove Successfully form Wishlist'),
        ], 200);
    }
}
