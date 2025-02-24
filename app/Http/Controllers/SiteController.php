<?php

namespace App\Http\Controllers;

use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use App\Models\Admin\SubCategory;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\FAQ;
use App\Models\Offer;
use App\Models\Productvariation;
use App\Models\Review;
use App\Models\Size;
use App\Models\Usecoupon;
use App\Models\UsefulLink;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class SiteController extends Controller
{
    public function index()
    {
        // Fetch commonly used data with eager loading and caching where applicable
        $productsQuery = Product::with('category', 'productvariations', 'sizes', 'brand', 'reviews', 'weights')->active()->orderBy('id', 'desc');

        $sliders = Slider::orderBy('id', 'desc')->get();
        $categories = Category::with('subcategoris')->withCount('products')->active()->orderBy('order', 'asc')->get();

        $products = $productsQuery->limit(40)->get();
        $brands = Brand::where('status', 1)->orderBy('id', 'desc')->get();
        $collections = Offer::orderBy('id', 'desc')->limit(4)->get();

        // Group similar product types into one query to avoid redundant database calls
        $productTypes = $productsQuery
            ->whereIn('type', [
                'special_offer',
                'flash_sale',
                'trending',
                'new_arrival',
                'feature',
            ])
            ->get()
            ->groupBy('type');

        $special_products = optional($productTypes->get('special_offer'))->take(3) ?? collect();
        $flash_products = optional($productTypes->get('flash_sale'))->take(3) ?? collect();
        $trande_products = optional($productTypes->get('trending'))->take(8) ?? collect();
        $new_arrival = optional($productTypes->get('new_arrival'))->take(8) ?? collect();
        $feature = optional($productTypes->get('feature'))->take(12) ?? collect();

        // Handle weekly and daily sales using scopes and avoid redundancy
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weeklySaleProduct = $this->getSaleProducts($startOfWeek, $endOfWeek, 6);

        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $todaySaleProduct = $this->getSaleProducts($startOfDay, $endOfDay, 6);

        // Handle optional data fallback
        $todaySaleProduct = $todaySaleProduct->isEmpty() ? $productsQuery->limit(6)->get() : $todaySaleProduct;
        $weeklySaleProduct = $weeklySaleProduct->isEmpty() ? $productsQuery->orderBy('id', 'asc')->limit(3)->get() : $weeklySaleProduct;
        $new_arrival = $new_arrival->count() < 8 ? $productsQuery->whereIn('type', ['new_arrival', 'trending'])->take(8)->get() : $new_arrival;
        $feature = $feature->isEmpty() ? $productsQuery->orderBy('id', 'asc')->limit(12)->get() : $feature;

        return view('frontend.index', compact(
            'sliders',
            'categories',
            'products',
            'special_products',
            'flash_products',
            'brands',
            'trande_products',
            'new_arrival',
            'collections',
            'feature',
            'todaySaleProduct',
            'weeklySaleProduct'
        ));
    }
    public function productDetails($slug)
    {

        $id = Session::get('varient_id');
        $product = Product::with(['category', 'sizes', 'weights', 'productvariations'])->where('slug', $slug)->first();

        $variation = Productvariation::where('product_id', $product->id)->where('id', $id)->first();

        $reviews = Review::with('user')->where('product_id', $product->id)->get();
        if ($variation) {
        } else {
            Session::forget('product_id');
            Session::put('product_id', $product->id);
            Session::forget('price');
            Session::forget('varient_id');
            Session::forget('size_id');
            Session::forget('weight_id');
        }
        return view('frontend.product-details', compact('product', 'reviews'));
    }

// Helper function to fetch sale products
    private function getSaleProducts($startDate, $endDate, $limit)
    {
        return Product::whereHas('orderproducts', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->limit($limit)
            ->get();
    }

    public function productSearch(Request $request)
    {
        $product_name = $request->product_search;
        if ($product_name != null) {
            $cProducts = Product::where("product_name", "LIKE", "%$product_name%")->paginate(12);
            if ($cProducts != null) {
                Session::forget('sub_category_id');
                Session::forget('brand_id');
                Session::forget('min_price');
                Session::forget('max_price');
                Session::forget('rating');
                $categories = Category::active()->with('subcategoris')->orderBy('id', 'desc')->get();
                $brands = Brand::orderBy('id', 'desc')->get();
                return view('frontend.search', compact('cProducts', 'categories', 'brands'));
            } else {
                return view('frontend.not-found');
            }
        } else {
            return view('frontend.not-found');
        }
    }

    public function faq()
    {
        $faqs = FAQ::get();
        return view('frontend.faq', compact('faqs'));
    }
    public function categoryProduct($slug)
    {
        Session::forget('sub_category_id');
        Session::forget('brand_id');
        Session::forget('min_price');
        Session::forget('max_price');
        Session::forget('rating');

        $id = Category::where('slug', $slug)->first()->id;
        $cProducts = Product::where('category_id', $id)->paginate(12);
        $categories = Category::active()->with('subcategoris')->orderBy('id', 'desc')->limit(8)->latest('id')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('frontend.category', compact('cProducts', 'categories', 'brands', 'id'));
    }

    public function subcategoryProduct($slug)
    {
        Session::forget('sub_category_id');
        Session::forget('brand_id');
        Session::forget('min_price');
        Session::forget('max_price');
        Session::forget('rating');

        $id = SubCategory::where('slug', $slug)->first()->id;
        $cProducts = Product::where('sub_category_id', $id)->paginate(12);
        $categories = Category::active()->with('subcategoris')->orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('frontend.category', compact('cProducts', 'categories', 'brands', 'id'));
    }
    public function loadcart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('frontend.include.cartinfo', ['carts' => $carts]);
    }
    public function stkyloadcart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('frontend.include.stky-cartinfo', ['carts' => $carts]);
    }
    public function varientdata(Request $request)
    {
        Session::put('product_id', $request->product_id);
        Session::put('varient_id', $request->varient_id);
        $size_id = Session::get('size_id');
        $weight_id = Session::get('weight_id');
        $varient_id = $request->varient_id;
        $sizes = Size::where('varient_id', $varient_id)->get();
        $weights = Weight::where('varient_id', $varient_id)->get();
        return view('frontend.include.varientinfo', compact('weights', 'sizes', 'size_id', 'weight_id'));
    }

    public function savesession(Request $request)
    {
        if ($request->size_id) {
            Session::forget('size_id');
            Session::put('size_id', $request->size_id);
            Session::put('price', $request->price);
            Session::put('product_id', $request->product_id);
            Session::put('varient_id', $request->varient_id);
            Session::forget('weight_id');
            $stock = Size::where('id', $request->size_id)->first();
        } else {
            Session::forget('weight_id');
            Session::put('weight_id', $request->weight_id);
            Session::put('price', $request->price);
            Session::put('varient_id', $request->varient_id);
            Session::put('product_id', $request->product_id);
            Session::forget('size_id');
            $stock = Weight::where('id', $request->weight_id)->first();
        }
        return response()->json($stock);
    }


    public function couponcheck(Request $request)
    {
        $available = Coupon::where('code', $request->coupon_code)
            ->where('validity', '>=', date('Y-m-d'))
            ->first();

        if (!$available) {
            Session::forget('couponcode');
            Session::forget('availablecoupon');
            $response = [
                'status' => 'invalid',
                'discount' => 0,
            ];
            return response()->json($response, 200);
        }

        $use = Usecoupon::where('user_id', Auth::id())
            ->where('coupon_id', $available->id)
            ->where('code', $request->coupon_code)
            ->first();

        if ($use) {
            $response = [
                'status' => 'false',
                'discount' => 0,
            ];
            return response()->json($response, 200);
        }

        // Calculate discount based on coupon type
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

        // If no discount applies for category coupons
        if ($discount <= 0) {
            $response = [
                'status' => 'invalid',
                'discount' => 0,
            ];
            return response()->json($response, 200);
        }

        // Save coupon data in session
        Session::put('couponcode', $request->coupon_code);
        Session::put('availablecoupon', $available);
        Session::put('discount', $discount);

        $response = [
            'status' => 'true',
            'discount' => $discount,
        ];
        return response()->json($response, 200);
    }

    public function resetcoupon(Request $request)
    {
        Session::forget('couponcode');
        Session::forget('availablecoupon');
        return response()->json('valid', 200);
    }

    public function getsubcategoryproduct(Request $request)
    {
        Session::forget('sub_category_id');
        Session::put('sub_category_id', $request->subcategory_id);
        $products = Product::query();

        $sc_id = Session::get('sub_category_id');
        $b_id = Session::get('brand_id');
        $minprice = Session::get('min_price');
        $maxprice = Session::get('max_price');
        $rating = Session::get('rating');

        if (isset($sc_id)) {
            $products->where('sub_category_id', $sc_id);
        }
        if (isset($b_id)) {
            $products->where('brand_id', $b_id);
        }
        if (isset($minprice) && isset($maxprice)) {
            $products->where('sub_category_id', $sc_id);
        } else {
            if (isset($minprice)) {
                $products->where('sub_category_id', $sc_id);
            } else {
            }
        }
        if (isset($rating)) {
            $products->where('rating', $rating);
        }
        $cProducts = $products->get();
        return view('frontend.include.productview', ['cProducts' => $cProducts]);
    }
    public function resetdata(Request $request, $data)
    {

        if ($data == 'sc') {
            Session::forget('sub_category_id');
        }
        if ($data == 'b') {
            Session::forget('brand_id');
        }
        if ($data == 'min') {
            Session::forget('min_price');
        }
        if ($data == 'max') {
            Session::forget('max_price');
        }
        if ($data == 'star') {
            Session::forget('rating');
        }
        return response()->json('success');
    }
    public function getbrandproduct(Request $request)
    {
        Session::forget('brand_id');
        Session::put('brand_id', $request->brand_id);
        $products = Product::query();

        $sc_id = Session::get('sub_category_id');
        $b_id = Session::get('brand_id');
        $minprice = Session::get('min_price');
        $maxprice = Session::get('max_price');
        $rating = Session::get('rating');

        if (isset($sc_id)) {
            $products->where('sub_category_id', $sc_id);
        }
        if (isset($b_id)) {
            $products->where('brand_id', $b_id);
        }
        if (isset($minprice) && isset($maxprice)) {
            $products->where('sub_category_id', $sc_id);
        } else {
            if (isset($minprice)) {
                $products->where('sub_category_id', $sc_id);
            } else {
            }
        }
        if (isset($rating)) {
            $products->where('rating', $rating);
        }
        $cProducts = $products->get();
        return view('frontend.include.productview', ['cProducts' => $cProducts]);
    }
    public function getratingproduct(Request $request)
    {
        Session::forget('rating');
        Session::put('rating', $request->rating);

        $products = Product::query();

        $sc_id = Session::get('sub_category_id');
        $b_id = Session::get('brand_id');
        $minprice = Session::get('min_price');
        $maxprice = Session::get('max_price');
        $rating = Session::get('rating');

        // Filter by sub-category
        if (isset($sc_id)) {
            $products->where('sub_category_id', $sc_id);
        }

        // Filter by brand
        if (isset($b_id)) {
            $products->where('brand_id', $b_id);
        }

        // Filter by price range
        if (isset($minprice) && isset($maxprice)) {
            $products->whereBetween('price', [$minprice, $maxprice]);
        } elseif (isset($minprice)) {
            $products->where('price', '>=', $minprice);
        } elseif (isset($maxprice)) {
            $products->where('price', '<=', $maxprice);
        }

        // Filter by rating
        if (isset($rating)) {
            $products->whereHas('reviews', function ($query) use ($rating) {
                $query->where('rating', $rating);
            });
        }

        $cProducts = $products->get();

        return view('frontend.include.productview', ['cProducts' => $cProducts]);
    }
    public function brandProduct($slug)
    {
        $id = Brand::where('slug', $slug)->first()->id;
        $bProducts = Product::where('brand_id', $id)->paginate(12);
        $categories = Category::active()->with('subcategoris')->orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('frontend.brand', compact('bProducts', 'categories', 'brands'));
    }

    public function shop(Request $request)
    {
        $cProducts = Product::active()->latest('id')->paginate(16);
        $categories = Category::active()->with('subcategoris')->orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            // Check if there are any products in this page
            if ($cProducts->isEmpty()) {
                return response()->json(['html' => '', 'hasMore' => false]);
            }

            $view = view('frontend.include.productview', compact('cProducts', 'categories', 'brands'))->render();

            // Include a `hasMore` flag in the response to indicate more products are available
            return response()->json(['html' => $view, 'hasMore' => true]);
        }

        return view('frontend.shop', compact('cProducts', 'categories', 'brands'));
    }

    public function productCollection($id)
    {

        $cProducts = Offer::find($id)->products()->paginate(12);

        $categories = Category::active()->with('subcategoris')->orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();

        return view('frontend.shop', compact('cProducts', 'categories', 'brands'));
    }

    public function loaddetails($slug)
    {

        $id = Session::get('varient_id');
        $product = Product::where('slug', $slug)->first();
        $variation = Productvariation::where('product_id', $product->id)->where('id', $id)->first();

        if ($variation) {
        } else {
            Session::forget('product_id');
            Session::put('product_id', $product->id);
            Session::forget('price');
            Session::forget('varient_id');
            Session::forget('size_id');
            Session::forget('weight_id');
        }
        return view('frontend.include.quickdetails', compact('product'));
    }


    public function contact()
    {
        return view('frontend.contact');
    }
    public function usefullLink($slug)
    {

        $useful_link = UsefulLink::where("slug", $slug)->first();

        return view('frontend.usefullink', compact('useful_link'));
    }
}
