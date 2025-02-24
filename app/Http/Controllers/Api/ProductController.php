<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Admin\Product;
use App\Models\Offer;
use App\Models\ProductAttribute;
use App\Models\Productvariation;
use App\Models\ProductVariationImage;
use App\Models\Size;
use App\Models\Weight;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function list(Request $request)
    {


        if ($request->collection_id) {

            $offer = Offer::find($request->collection_id);

            if ($offer) {

                $products = $offer->products()
                    ->with(['productvariations', 'sizes', 'weights', 'reviews']) // eager load relationships
                    ->withAvg('reviews', 'rating') // calculate average rating
                    ->paginate(12);
                // Paginate the results

                // Format the paginated products
                $formattedProducts = $products->getCollection()->map(function ($product) {
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
                        'supplier_id' => $product->supplier_id,
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
                                    ];
                                }),
                            ];
                        }),
                        'sizes' => $product->sizes->sortBy('RegularPrice')->values()->all(),
                        'weights' => $product->weights,
                        // Include other fields as needed
                    ];
                });

                // return ApiResponse::list('Product List', $products);

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

                return ApiResponse::list('Product List', $formattedProducts);
            } else {

                return ApiResponse::list('Product Not Found', null);
            }

        }

        $perPage = 20; // Number of items per page

        // Base query with eager loading of relationships
        $query = Product::where('status','Active')->latest('id')->select([
            'products.id',
            'products.product_name',
            'products.slug',
            'products.product_sku',
            'products.category_id',
            'products.sub_category_id',
            'products.child_category_id',
            'products.brand_id',
            'products.product_description',
            'products.gander',
            'products.youtube_embadecode',
            'products.shipping_type',
            'products.shippig_cost',
            'products.shipping_rtn_policy',
            'products.offer_start',
            'products.offer_end',
            'products.discount_percent',
            'products.multiple_qty',
            'products.meta_name',
            'products.meta_title',
            'products.meta_image',
            'products.meta_keywords',
            'products.meta_description',
            'products.total_stock',
            'products.available',
            'products.sold',
            'products.status',
            'products.type',
            'products.supplier_id',
            'products.created_at',
            'products.updated_at',
        ])
            ->leftJoin('sizes', 'products.id', '=', 'sizes.product_id')
            ->groupBy([
                'products.id',
                'products.product_name',
                'products.slug',
                'products.product_sku',
                'products.category_id',
                'products.sub_category_id',
                'products.child_category_id',
                'products.brand_id',
                'products.product_description',
                'products.gander',
                'products.youtube_embadecode',
                'products.shipping_type',
                'products.shippig_cost',
                'products.shipping_rtn_policy',
                'products.offer_start',
                'products.offer_end',
                'products.discount_percent',
                'products.multiple_qty',
                'products.meta_name',
                'products.meta_title',
                'products.meta_image',
                'products.meta_keywords',
                'products.meta_description',
                'products.total_stock',
                'products.available',
                'products.sold',
                'products.status',
                'products.supplier_id',
                'products.type',
                'products.created_at',
                'products.updated_at',
            ])
            ->with(['productvariations', 'sizes', 'weights', 'reviews'])
            ->withAvg('reviews', 'rating');

        //Filter
        if ($request->filter_type) {
            $query->where('type', $request->filter_type);
        }

        if ($request->sub_category_id) {
            $query->where('sub_category_id', $request->sub_category_id);
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->brand_id) {
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
        // Sorting by maximum price within the sizes
        if ($request->sort == 'low_to_high') {

            $query->orderBy(function ($q) {
                $q->select('sizes.SalePrice')
                    ->from('sizes')
                    ->whereColumn('sizes.product_id', 'products.id')
                    ->orderBy('sizes.id', 'asc')
                    ->limit(1);
            }, 'ASC');
        }


        if ($request->sort == 'high_to_low') {

            $query->orderBy(function ($q) {
                $q->select('sizes.SalePrice')
                    ->from('sizes')
                    ->whereColumn('sizes.product_id', 'products.id')
                    ->orderBy('sizes.id', 'asc')
                    ->limit(1);
            }, 'DESC');
        }
        if ($request->sort == 'discount') {
            $query->orderBy(function ($q) {
                $q->select('sizes.Discount')
                    ->from('sizes')
                    ->whereColumn('sizes.product_id', 'products.id')
                    ->orderBy('sizes.id', 'asc')
                    ->limit(1);
            }, 'DESC');
        }
        if ($request->sort == 'top_rated') {
            $query->orderBy('reviews_avg_rating', 'DESC');
        }

        // Paginate the results
        $products = $query->groupBy('products.id')->paginate(12);

        $formattedProducts = $products->getCollection()->map(function ($product) {
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
                'supplier_id' => $product->supplier_id,
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

        return ApiResponse::list('Product List', $products);
    }

    public function singlePage(Request $request)
    {

        $product_id = $request->product_id;
        $product = Product::with('productvariations', 'sizes', 'weights')->findOrFail($product_id);

        return response()->json([
            'title' => 'Product Details Page',
            'data' => [
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
                'supplier_id' => $product->supplier_id,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
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
                        'mulliple_images' => $variation->productvariationimages->map(function ($image) {
                            return [
                                'id' => $image->id,
                                'product_variation_id' => $image->variation_id,
                                'image_path' => $image->image_path,
                            ];
                        }),
                        'sizes' => $variation->sizes->map(function ($size) {
                            return [
                                'id' => $size->id,
                            ];
                        }),
                    ];
                }),
                'sizes' => $product->sizes, // Assuming you want all sizes directly under the product as well
                'weights' => $product->weights,
                'rating' => $product->reviews->avg('rating'), // Calculate average rating

            ],
        ]);
    }

    public function store(Request $request)
    {

        if ($request->product_id == null) {
            $product = new Product();
        } else {
            $product = Product::where('id', $request->product_id)->first();
        }
        $product->product_name = $request->product_name;
        $product->product_sku = $request->product_sku;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->child_category_id = $request->child_category_id;
        $product->product_description = $request->product_description;
        $product->youtube_embadecode = $request->youtube_embadecode;

        if ($request->gander != 'undefined') {
            $product->gander = $request->gander;
        } else {
            $product->gander = null;
        }
        if ($request->shipping_type != 'undefined') {
            $product->shipping_type = $request->shipping_type;
        } else {
            $product->shipping_type = null;
        }
        $product->shippig_cost = $request->shippig_cost;
        $product->shipping_rtn_policy = $request->shipping_rtn_policy;
        if ($request->offer_start != 'NULL') {
            $product->offer_start = $request->offer_start;
        } else {
            $product->offer_start == null;
        }
        if ($request->offer_end != 'NULL') {
            $product->offer_end = $request->offer_end;
        } else {
            $product->offer_end == null;
        }

        if (isset($request->discount_percent)) {
            $product->discount_percent = $request->discount_percent;
        } else {
            $product->discount_percent = 0;
        }
        if ($request->multiple_qty != 'undefined') {
            $product->multiple_qty = $request->multiple_qty;
        } else {
            $product->multiple_qty = null;
        }
        $product->meta_name = $request->meta_name;
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;
        $product->supplier_id = $request->supplier_id;
        $product->advance_payment_amount = $request->advance_payment_amount;
        $product->type = $product->type = $request->type;
        $product->status = $request->status ?? 'Inactive';

        if ($request->hasFile('meta_image')) {
            $meta_image = $request->file('meta_image');

            // Generate a unique file name with the current timestamp
            $name = time() . "_" . $meta_image->getClientOriginalName();

            // Define the full upload path using public_path()
            $uploadPath = public_path('images/meta/');
            if ($product->meta_image) {
                unlink($product->meta_image);
            }
            // Move the file to the target directory
            $meta_image->move($uploadPath, $name);

            // Save the relative path to the image in the database
            $product->meta_image = 'public/images/meta/' . $name;
        }

        $product->save();

        return ApiResponse::created('Product Added Successfully', $product);

    }
    public function productVariation()
    {
        $productVariations = Productvariation::get();
        return ApiResponse::created('Product variation list', $productVariations);
    }

    public function productVariationStore(Request $request)
    {
        // Check if variation already exists
        $varex = Productvariation::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->first();

        if (isset($varex)) {
            return response()->json('exist', 200);
        }

        // Create new variation
        $variation = new Productvariation();
        $variation->product_id = $request->product_id;

        if (isset($request->color_id)) {
            $variation->color_id = $request->color_id;
            $variation->color = ProductAttribute::where('id', $request->color_id)->first()->name;
            $variation->color_code = ProductAttribute::where('id', $request->color_id)->first()->color_code;
        }

        if (isset($request->code_id)) {
            $variation->code_id = $request->code_id;
            $variation->code = ProductAttribute::where('id', $request->code_id)->first()->name;
        }
        $variation->image = 'default.jpg';

        $result = $variation->save();

        // Handle multiple images
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            foreach ($photos as $index => $photo) {
                $name = time() . "_" . $photo->getClientOriginalName();

                // Store the image in the 'public/images/variation/' directory
                $uploadPath = 'images/variation/';
                $photo->move(public_path($uploadPath), $name);
                $imagePath = $uploadPath . $name;

                // Save the first image to the Productvariation table
                if ($index == 0) {
                    $variation->image = 'public/' . $imagePath;
                    $variation->save(); // Update the variation with the first image
                }

                // Save each image in the product_variation_images table
                $variationImage = new ProductVariationImage();
                $variationImage->variation_id = $variation->id;
                $variationImage->image_path = 'public/' . $imagePath;
                $variationImage->save();
            }
        }

        // Save sizes and weights
        if ($request->size) {
            $sizes = $request->size;
        }
        if ($request->weight) {
            $weights = $request->weight;
        }
        $product = Product::where('id', $request->product_id)->first();
        $totalStock = 0;

        if ($result) {
            if (!empty($sizes)) {
                foreach ($sizes as $si) {
                    $size = new Size();
                    $size->product_id = $request->product_id;
                    $size->varient_id = $variation->id;
                    $size->size_id = $si['sizeID'];
                    $size->size = $si['size'];
                    $size->RegularPrice = $si['RegularPrice'];
                    $size->Discount = $si['Discount'];
                    $size->SalePrice = $si['RegularPrice'] - $si['Discount'];
                    $size->stock = $si['Stock'];
                    $size->total_stock = $si['Stock'];
                    $size->buy_price = $si['buy_price'];
                    $totalStock += $si['Stock'];
                    $size->save();
                }
            }
            if (!empty($weights)) {
                foreach ($weights as $we) {
                    $weight = new Weight();
                    $weight->product_id = $request->product_id;
                    $weight->varient_id = $variation->id;
                    $weight->weight_id = $we['weightID'];
                    $weight->weight = $we['weight'];
                    $weight->RegularPrice = $we['RegularPrice'];
                    $weight->Discount = $we['Discount'];
                    $weight->SalePrice = $we['RegularPrice'] - $we['Discount'];
                    $weight->stock = $we['Stock'];
                    $weight->total_stock = $we['Stock'];
                    $weight->save();
                }
            }
        }

        // Update product stock
        $product->status = "Active";
        $product->total_stock = $totalStock;
        $product->save();
        $data = [
            'variation' => $variation,
            'variationImage' => $variationImage,
            'product' => $product,
        ];

        return ApiResponse::created('Product Variation Created Successfully', $data);
    }

    public function variationupdate(Request $request)
    {
        // Ensure product_id is being passed
        if (!$request->product_id) {
            return response()->json(['error' => 'Product ID is required'], 400);
        }

        $variation_id = $request->variation_id;
        $variation = Productvariation::find($variation_id);

        if (!$variation) {
            return response()->json('Variation not found', 404);
        }

        $product_id = $request->product_id;

        // Update sizes
        if ($request->size) {
            $sizes = $request->size;

            // Delete old sizes for the variation
            Size::where('varient_id', $variation->id)->delete();

            foreach ($sizes as $si) {
                $size = new Size();
                $size->product_id = $product_id; // Ensure product_id is assigned
                $size->varient_id = $variation->id;
                $size->size_id = $si['sizeID'];
                $size->size = $si['size'];
                $size->RegularPrice = $si['RegularPrice'];
                $size->Discount = $si['Discount'];
                $size->SalePrice = $si['RegularPrice'] - $si['Discount'];
                $size->stock = $si['Stock'];
                $size->buy_price = $si['buy_price'];
                $size->total_stock = $si['Stock'];
                $size->save();
            }
        }

        // Handle multiple images update
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');

            // Delete old images for the variation
            $oldImages = ProductVariationImage::where('variation_id', $variation->id)->get();
            foreach ($oldImages as $image) {
                // Remove image file from storage
                if (file_exists($image->image_path)) {
                    unlink($image->image_path);
                }
            }
            ProductVariationImage::where('variation_id', $variation->id)->delete();

            foreach ($photos as $index => $photo) {
                // Save new images
                $name = time() . "_" . $photo->getClientOriginalName();
                $uploadPath = 'images/variation/';

                $photo->move(public_path($uploadPath), $name);
                $imagePath = $uploadPath . $name;

                // Update the first image as the main image for the variation
                if ($index == 0) {
                    // Remove old main image file from storage
                    if ($variation->image && file_exists(public_path($variation->image))) {
                        unlink(public_path($variation->image));
                    }
                    $variation->image = 'public/' . $imagePath;
                    $variation->save(); // Update the variation with the first image
                }

                // Save images in the product_variation_images table
                $variationImage = new ProductVariationImage();
                $variationImage->variation_id = $variation->id;
                $variationImage->image_path = 'public/' . $imagePath;
                $variationImage->save();
            }
        }

        // Continue with other logic (weights, total stock, etc.)
        if ($request->weight) {
            $weights = $request->weight;

            // Delete old weights for the variation
            Weight::where('varient_id', $variation->id)->delete();

            foreach ($weights as $we) {
                $weight = new Weight();
                $weight->product_id = $product_id;
                $weight->varient_id = $variation->id;
                $weight->weight_id = $we['weightID'];
                $weight->weight = $we['weight'];
                $weight->RegularPrice = $we['RegularPrice'];
                $weight->Discount = $we['Discount'];
                $weight->SalePrice = $we['RegularPrice'] - $we['Discount'];
                $weight->stock = $we['Stock'];
                $weight->total_stock = $we['Stock'];
                $weight->save();
            }
        }

        // Update product stock
        $product = Product::where('id', $product_id)->first();
        $product->status = "Active";
        $sizesStock = $variation->sizes ? $variation->sizes->sum('stock') : 0;

        $product->total_stock = $sizesStock;
        $product->save();

        $data = [
            'variation' => $variation,
            'variationImage' => $variationImage,
            'product' => $product,
        ];

        return ApiResponse::created('Product Variation Updated Successfully', $data);
    }

    public function sortType()
    {
        $type = [
            [
                'status' => 'New Arrival',
                'value' => 'new_arrival',
            ],
            [
                'status' => 'Trending',
                'value' => 'trending',
            ],
            [
                'status' => 'Flash Sale',
                'value' => 'flash_sale',
            ],
            [
                'status' => 'Special Offer',
                'value' => 'special_offer',
            ],
        ];
        $sort = [
            [
                'status' => 'Price Low-High',
                'value' => 'low_to_high',
            ],
            [
                'status' => 'Price High-Low',
                'value' => 'high_to_low',
            ],
            [
                'status' => 'Discount',
                'value' => 'discount',
            ], [
                'status' => 'Top Rated',
                'value' => 'top_rated',
            ],
        ];

        $data = [
            'type' => $type,
            'sort' => $sort,
        ];
        return ApiResponse::created('Sort & Type list', $data);
    }
    public function offerCollection()
    {
        $offerCollection = Offer::get();
        return ApiResponse::list('Product Offer Collection List', $offerCollection);
    }

    public function variationImageDelete(Request $request)
    {
        $image = ProductVariationImage::find($request->product_variation_id);

        if ($image) {
            // Remove the image from storage if needed
            // Storage::delete($image->image_path);
            if (file_exists($image->image_path)) {
                unlink($image->image_path);
            }

            // Delete the image record from the database
            $image->delete();

            return ApiResponse::list('Image deleted successfully');
        }

        return response()->json(['error' => 'Image not found'], 404);
    }
}
