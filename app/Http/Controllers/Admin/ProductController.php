<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\ProductAttribute;
use App\Models\Productvariation;
use App\Models\ProductVariationImage;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\Weight;
use DataTables;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'productvariations', 'sizes')->latest('id')->where('status', 'Active')->get();
        return view('admin.pages.products.index', ['products' => $products]);
    }
    public function productDetails()
    {
        $products = Product::with('category')->where('status', 'Active')->get();
        return view('admin.pages.products.productdetails', ['products' => $products]);
    }

    public function slugproduct($status)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.pages.products.index', ['categories' => $categories, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('admin.pages.products.create', ['categories' => $categories, 'brands' => $brands, 'suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        if ($request->product_id == null) {
            $product = new Product();
        } else {
            $product = Product::where('id', $request->product_id)->first();
        }
        $product->product_name = $request->product_name;
        $product->product_sku = $request->product_sku;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->child_category_id = $request->child_category_id;
        $product->product_description = $request->product_description;
        $product->youtube_embadecode = $request->youtube_embadecode;
        $product->supplier_id = $request->supplier_id;
        $product->advance_payment_amount = $request->advance_payment_amount;

        if ($request->child_category_id != 'null') {
            $product->child_category_id = $request->child_category_id;
        } else {
            $product->child_category_id = null;
        }
        if ($request->gander != 'undefined') {
            $product->gander = $request->gander;
        } else {
            $product->gander = null;
        }
        if ($request->supplier_id != 'undefined') {
            $product->supplier_id = $request->supplier_id;
        } else {
            $product->supplier_id = null;
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
        $product->status = $request->status;
        $product->type = $request->type;

        if ($request->hasFile('meta_image')) {
            $category_icon = $request->file('meta_image');
            $name = time() . "_" . $category_icon->getClientOriginalName();
            $uploadPath = ('public/images/meta/');
            if ($product->meta_image && file_exists($product->meta_image)) {

                unlink($product->meta_image);
            }
            $category_icon->move($uploadPath, $name);
            $category_iconImgUrl = $uploadPath . $name;
            $product->meta_image = $category_iconImgUrl;
        }

        $product->status = $request->status ?? "Inactive";
        $product->save();
        return response()->json($product, 200);
    }

    public function variation(Request $request)
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
                $uploadPath = 'public/images/variation/';
                $photo->move($uploadPath, $name);
                $imagePath = $uploadPath . $name;

                // Save first image to the Productvariation table
                if ($index == 0) {
                    $variation->image = $imagePath;
                    $variation->save(); // Update the variation with the first image
                }

                // Save image in product_variation_images table
                $variationImage = new ProductVariationImage();
                $variationImage->variation_id = $variation->id;
                $variationImage->image_path = $imagePath;
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

        return response()->json($variation, 200);
    }

    public function variationImageDelete(Request $request)
    {
        $image = ProductVariationImage::find($request->id);

        if ($image) {
            // Remove the image from storage if needed

            if (file_exists($image->image_path)) {
                unlink($image->image_path);
            }

            // Delete the image record from the database
            $image->delete();
            $variation_id = $image->variation_id;
            $image = ProductVariationImage::where('variation_id', $variation_id)->first();

            $variation = Productvariation::find($variation_id);
            $variation->image = $image->image_path;
            $variation->save();

            return response()->json(['success' => __('backend.Image deleted successfully')]);
        }

        return response()->json(['error' => __('backend.Image not found')], 404);
    }

    public function variationupdate(Request $request)
    {

        // Ensure product_id is being passed
        if (!$request->product_id) {
            return response()->json(['error' => 'Product ID is required'], 400);
        }

        $variation_id = $request->variation_id;
        $variation = Productvariation::find($variation_id);
        if (isset($request->color_id)) {
            $variation->color_id = $request->color_id;
            $variation->color = ProductAttribute::where('id', $request->color_id)->first()->name;
            $variation->color_code = ProductAttribute::where('id', $request->color_id)->first()->color_code;
            $variation->save();
        }

        if (isset($request->code_id)) {
            $variation->code_id = $request->code_id;
            $variation->code = ProductAttribute::where('id', $request->code_id)->first()->name;
            $variation->save();
        }

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
                $size->total_stock = $si['Stock'];
                $size->buy_price = $si['buy_price'];
                $size->save();
            }
        }

        // Handle multiple images update
        $existingImages = ProductVariationImage::where('variation_id', $variation->id)->get(); // Get existing images
        $existingImagePaths = $existingImages->pluck('image_path')->toArray(); // Store existing image paths

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');

            // First, delete old images if no new images were uploaded
            if ($photos) {
                ProductVariationImage::where('variation_id', $variation->id)->delete(); // Clear previous images

                foreach ($photos as $index => $photo) {
                    // Save new images
                    $name = time() . "_" . $photo->getClientOriginalName();
                    $uploadPath = 'public/images/variation/';
                    $photo->move($uploadPath, $name);
                    $imagePath = $uploadPath . $name;

                    // Update the first image as the main image for the variation
                    if ($index == 0) {
                        $variation->image = $imagePath;
                        $variation->save(); // Update the variation with the first image
                    }

                    // Save images in the product_variation_images table
                    $variationImage = new ProductVariationImage();
                    $variationImage->variation_id = $variation->id;
                    $variationImage->image_path = $imagePath;
                    $variationImage->save();
                }
            }

            // Reinsert existing images to keep them
            foreach ($existingImagePaths as $path) {
                if (!in_array($path, array_column($photos, 'name'))) { // Only add if it's not a newly uploaded image
                    $variationImage = new ProductVariationImage();
                    $variationImage->variation_id = $variation->id;
                    $variationImage->image_path = $path;
                    $variationImage->save();
                }
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

        return response()->json($variation, 200);
    }

    public function variationstatus(Request $request)
    {
        $variation = Productvariation::where('id', $request->variation_id)->first();
        $variation->status = $request->status;
        $variation->update();
        return response()->json($variation, 200);
    }

    public function loadvariation(Request $request)
    {
        $variations = Productvariation::where('product_id', $request->product_id)->get();
        return view('admin.pages.products.variationlist', ['variations' => $variations]);
    }

    public function variationview($id)
    {
        $variations = Productvariation::where('id', $id)->first();
        $sizes = Size::where('varient_id', $id)->get();
        $weights = Weight::where('varient_id', $id)->get();
        return view('admin.pages.products.variationeditmodal', ['variations' => $variations, 'sizes' => $sizes, 'weights' => $weights]);
        // return view('admin.pages.products.variationmodal', ['variations' => $variations, 'sizes' => $sizes, 'weights' => $weights]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function variationdelete($id)
    {
        $variation = Productvariation::where('id', $id)->first();

        $sizes = Size::where('varient_id', $id)->get();
        foreach ($sizes as $size) {
            $size->delete();
        }
        $weights = Weight::where('varient_id', $id)->get();
        foreach ($weights as $weight) {
            $weight->delete();
        }
        $variation->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('backend.Variation Delete Successfully!'),
        ], 200);
    }

    public function sizedelete($id)
    {
        $sizes = Size::where('id', $id)->first();
        $sizes->delete();
        return response()->json([
            'status' => 'success',
            'message' => __("backend.Size Delete Successfully!"),
        ], 200);
    }

    public function weightdelete($id)
    {
        $weight = Weight::where('id', $id)->first();
        $weight->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Weight Delete Successfully!',
        ], 200);
    }

  
    //query optimize
    public function productdata(Request $request)
    {

        $query = Product::query();

        // Apply filters
        if ($request->status !== 'All') {
            $query->where('status', $request->status);
        }

        if ($request->category_id !== 'All') {
            $query->where('category_id', $request->category_id);
        }

        // Eager load relationships
        $products = $query->with(['sizes', 'weights', 'category', 'productVariations'])
            ->orderBy('id', 'desc')
            ->get();

        return Datatables::of($products)
            ->addColumn('price', function ($product) {
                $price = $product->sizes->first() ?? $product->weights->first();
                return $price ? $price->RegularPrice : 'Not apply';
            })
            ->addColumn('saleprice', function ($product) {
                $price = $product->sizes->first() ?? $product->weights->first();
                return $price ? $price->SalePrice : 'Not apply';
            })
            ->addColumn('buy_price', function ($product) {
                $buyPrice = $product->sizes->first() ?? $product->weights->first();
                return $buyPrice ? $buyPrice->buy_price : 'Not apply';
            })
            ->addColumn('category', function ($product) {
                return $product->category ? $product->category->category_name : 'No Category';
            })
            ->addColumn('image', function ($product) {
                $image = $product->productVariations->first();
                return $image
                ? '<img src="../../' . $image->image . '" height="40" alt="No Image" />'
                : '<img src="../../public/dumy.jpg" height="40" alt="No Image" />';
            })
            ->addColumn('action', function ($product) {
                $btn = '<div class="dropdown-product-list">
                        <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                        <div id="myDropdown" class="dropdown-product-list-content">
                          <a class="label rounded" href="../product/view-details/' . $product->id . '"><span>
                            <i class="fa-regular fa-eye mr-1"></i></span>Details</a>
                          <a class="label rounded" href="../product/edit/' . $product->id . '"><span>
                          <i class="fa-solid fa-pen-to-square mr-1"></i></span>Edit</a>
                            <a type="button" class="label rounded confirmDelete" data-id="' . $product->id . '" id="productDelete" href="javascript:void(0)"><span>
                                <i class="fa-regular fa-trash-can mr-1"></i></span>Delete</a>
                        </div>
                      </div>';
                return $btn;
            })
            ->escapeColumns([])->make();
    }

    public function downloadexcel(Request $request)
    {
        $status = $request->status;
        $category_id = $request->category_id;
        return Excel::download(new ProductExport($status, $category_id), date('Y-m-d') . 'productlist.xlsx');
    }

    public function downloadproduct(Request $request)
    {
        if ($request->status == 'All' && $request->category_id == 'All') {
            $products = Product::all();
        } else {
            if ($request->status == 'All' && $request->category_id != 'All') {
                $products = Product::where('category_id', $request->category_id)->get();
            } else {
                if ($request->status != 'All' && $request->category_id == 'All') {
                    $products = Product::where('status', $request->status)->get();
                } else {
                    if ($request->status != 'All' && $request->category_id != 'All') {
                        $products = Product::where('status', $request->status)->where('category_id', $request->category_id)->get();
                    } else {
                        $products = Product::all();
                    }
                }
            }
        }
        $data = [
            'title' => 'Product List PDF',
            'date' => date('Y-m-d'),
            'products' => $products,
        ];

        $pdf = PDF::loadView('admin.pages.products.datapdf', $data);

        return $pdf->download('productdata.pdf');
    }

    public function viewver($id)
    {
        $variations = Productvariation::where('id', $id)->first();
        $sizes = Size::where('varient_id', $id)->get();
        $weights = Weight::where('varient_id', $id)->get();
        return view('admin.pages.products.variationviewmodal', ['variations' => $variations, 'sizes' => $sizes, 'weights' => $weights]);
    }

    public function edit($id)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $product = Product::where('id', $id)->first();
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('admin.pages.products.edit', ['brands' => $brands, 'product' => $product, 'categories' => $categories, 'suppliers' => $suppliers]);
    }

    public function viewdetails($id)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $product = Product::where('id', $id)->first();
        return view('admin.pages.products.productdetails', ['brands' => $brands, 'product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function getsize(Request $request)
    {
        if (isset($request['q'])) {
            $variants = ProductAttribute::where('value', 2)->where('name', 'like', '%' . $request['q'] . '%')->get();
        } else {
            $variants = ProductAttribute::where('value', 2)->get();
        }
        $variant = array();
        foreach ($variants as $item) {
            $variant[] = array(
                "id" => $item['id'],
                "text" => $item['name'],
            );
        }
        $data['data'] = $variant;
        return json_encode($data);
        die();
    }

    public function getweight(Request $request)
    {
        if (isset($request['q'])) {
            $variants = ProductAttribute::where('value', 3)->where('value', 'like', '%' . $request['q'] . '%')->get();
        } else {
            $variants = ProductAttribute::where('value', 3)->get();
        }
        $variant = array();
        foreach ($variants as $item) {
            $variant[] = array(
                "id" => $item['id'],
                "text" => $item['name'],
            );
        }
        $data['data'] = $variant;
        return json_encode($data);
        die();
    }

    public function statusupdate(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $product->status = $request->status;
        $product->update();
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('backend.Product Delete Successfully!'),
        ], 200);
    }

}
