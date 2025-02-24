<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Productvariation;
use App\Models\Size;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function productSearch(Request $request)
    {
        $product_name = $request->product_search;

        if ($product_name != null) {


            $query = Product::select('products.*')
            ->with(['productvariations', 'sizes', 'weights', 'reviews'])
            ->where("product_name", "LIKE", "%$product_name%")
            ->groupBy('products.id');

            // Apply filters
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('brand_id')) {
                $query->where('brand_id', $request->brand_id);
            }
            if ($request->filter_color) {
                $color_ids = Productvariation::where('color_id', $request->filter_color)->pluck('product_id')->toArray();
                $query->whereIn('products.id', $color_ids);
            }

            if ($request->filter_size) {
                $size_ids = Size::where('size_id', $request->filter_size)->pluck('product_id')->toArray();
                $query->whereIn('products.id', $size_ids);
            }

            if ($request->filter_type) {
                $query->where('type', $request->filter_type);
            }

            // Apply sorting
            if ($request->sort == 'low_to_high') {

                $query->orderBy(function ($q) {
                    $q->select('sizes.SalePrice')
                      ->from('sizes')
                      ->whereColumn('sizes.product_id', 'products.id')
                      ->orderBy('sizes.id', 'asc')
                      ->limit(1);
                }, 'ASC');

            } elseif ($request->sort == 'high_to_low') {
                $query->orderBy(function ($q) {
                    $q->select('sizes.SalePrice')
                      ->from('sizes')
                      ->whereColumn('sizes.product_id', 'products.id')
                      ->orderBy('sizes.id', 'asc')
                      ->limit(1);
                }, 'DESC');

            } elseif ($request->sort == 'discount') {

                $query->orderBy(function ($q) {
                    $q->select('sizes.Discount')
                      ->from('sizes')
                      ->whereColumn('sizes.product_id', 'products.id')
                      ->orderBy('sizes.id', 'asc')
                      ->limit(1);
                }, 'DESC');
            } elseif ($request->sort == 'top_rated') {
                $query->withAvg('reviews', 'rating')
                    ->orderBy('reviews_avg_rating', 'DESC');
            }

            // $products = $query->paginate(12);

            $products = $query->groupBy('products.id')->paginate(12);

            $formattedProducts = $products->getCollection()->transform(function ($product) {
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'slug' => $product->slug,
                    'product_sku' => $product->product_sku,
                    'category_id' => $product->category_id,
                    'sub_category_id' => $product->sub_category_id,
                    'child_category_id' => $product->child_category_id,
                    'brand_id' => $product->brand_id,
                    'product_description' => $product->product_description,
                    'gander' => $product->gander,
                    'youtube_embadecode' => $product->youtube_embadecode,
                    'shipping_type' => $product->shipping_type,
                    'shippig_cost' => $product->shippig_cost,
                    'shipping_rtn_policy' => $product->shipping_rtn_policy,
                    'offer_start' => $product->offer_start,
                    'offer_end' => $product->offer_end,
                    'discount_percent' => $product->discount_percent,
                    'multiple_qty' => $product->multiple_qty,
                    'meta_name' => $product->meta_name,
                    'meta_title' => $product->meta_title,
                    'meta_image' => $product->meta_image,
                    'meta_keywords' => $product->meta_keywords,
                    'meta_description' => $product->meta_description,
                    'total_stock' => $product->total_stock,
                    'available' => $product->available,
                    'sold' => $product->sold,
                    'status' => $product->status,
                    'type' => $product->type,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                    'reviews_avg_rating' => round($product->reviews_avg_rating, 1), // Include the average rating and round it
                    'productvariations' => $product->productvariations->map(function ($variation) {
                        return [
                            'id' => $variation->id,
                            'product_id' => $variation->product_id,
                            'image' => $variation->image,
                            'color_id' => $variation->color_id,
                            'color' => $variation->color,
                            'color_code' => $variation->color_code,
                            'code_id' => $variation->code_id,
                            'code' => $variation->code,
                            'status' => $variation->status,
                            'created_at' => $variation->created_at,
                            'updated_at' => $variation->updated_at,
                            'sizes' => $variation->sizes->map(function ($size) {
                                return [
                                    'id' => $size->id,
                                    // Add other size fields if needed
                                ];
                            }),
                        ];
                    }),
                    'sizes' => $product->sizes->sortBy('SalePrice')->values()->all(),
                    'weights' => $product->weights,
                    // Include other fields as needed
                ];
            });

            return response()->json([
                'title' => 'Product List',
                'data' => [
                    'current_page' => $products->currentPage(),
                    'data' => $formattedProducts,
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'last_page' => $products->lastPage(),
                    'next_page_url' => $products->nextPageUrl(),
                    'prev_page_url' => $products->previousPageUrl(),
                ],
            ]);

        }
    }

}
