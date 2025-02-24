<?php

namespace App\Http\Controllers\Api;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class WishlistController extends Controller
{
    public function allWishlist(){
        $user_id = auth()->user()->id;

        $wishlists = Wishlist::where('user_id',$user_id)->get()->map(function($wishlist){
            return [
                'user_id'=>$wishlist->user_id,
                'product_id'=>$wishlist->product_id,
                'product_name'=>$wishlist->product->product_name,
                'regular_price'=>$wishlist->size->RegularPrice,
                'sale_price'=>$wishlist->size->SalePrice,
                'image'=>$wishlist->productvariation->image,
                'rating' => $wishlist->product->reviews->avg('rating') ?? 0,
            ];
        });
        return ApiResponse::list('All Wishlist',$wishlists);
    }
    public function addWishlist(Request $request){

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
            return ApiResponse::created('Add Wishlist Successfully');
        }else{
            return ApiResponse::created('Already Added in Wishlist');
        }

    }
    public function removeWishlist(Request $request){
        $product_id = $request->product_id;
        $user_id = auth()->user()->id;
        $wishlist = Wishlist::where('user_id',$user_id)->where('product_id',$product_id);
        $wishlist->delete();
        return ApiResponse::created('Item Remove Successfully form Wishlist');

    }
    public function allRemoveWishlist(Request $request){
        $user_id = auth()->user()->id;
        $wishlist = Wishlist::where('user_id',$user_id);
        $wishlist->delete();
        return ApiResponse::created('All Item Remove Successfully form Wishlist');

    }
}
