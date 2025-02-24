<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\ChildCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('order','ASC')->get();
        return view('admin.pages.category.index',compact('categories'));
    }
    public function reorder(Request $request)
    {

        $data = Category::all();

        foreach ($data as $category) {

            foreach ($request->order as $order) {

                if ($order['id'] == $category->id) {

                    $category->update(['order' => $order['position']]);
                }
            }
        }
        Toastr::success(__("Updated Successfully!"));
       return back();
    }
    // public function ajraTable(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Category::latest('id')->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($data) {
    //                 $btn = '<div class="dropdown-product-list ">
    //                         <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
    //                         <div id="myDropdown" class="dropdown-product-list-content">
    //                           <a type="button" class="label rounded categoryDetails"
    //                           href="javascript:void(0)" data-id="' . $data->id . '" id="categoryDetails"><span
    //                             ><i class="fa-regular fa-eye mr-1"></i
    //                           ></span> ' . __('backend.Details') . '</a>

    //                           <a type="button" class="label rounded"
    //                         href="javascript:void(0)" id="categoryEdit" data-id="' . $data->id . '"><span
    //                             ><i
    //                               class="fa-solid fa-pen-to-square mr-1"
    //                             ></i
    //                           ></span>' . __('backend.Edit') . '</a>

    //                                     <a type="button" class="confirmDelete label rounded"
    //                         href="javascript:void(0)"  data-id="' . $data->id . '"><span
    //                             ><i
    //                               class="fa-solid fa-pen-to-square mr-1"
    //                             ></i
    //                           ></span>'.__('backend.Delete').'</a>



    //                         </div>
    //                       </div>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories,category_name',
            'category_desc' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);

        try {
            $category =  Category::create($validated);
            if ($request->hasFile('image')) {
                $path = 'backend/images/category/';
                imageUploaded($request,$path,$category);
            }
        } catch (Exception $e) {

            return __("frontend.Opps! Someting went wrong.Please try again.");
        }
        Toastr::success(__("frontend.Category Created Successfully!"));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function getsubcategory($id)
    {
        $subcategory = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategory, 200);
    }

    public function getchildcategory($id)
    {
        $childcategory = ChildCategory::where('subcategory_id', $id)->get();
        return response()->json($childcategory, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'category_name' => 'nullable|string',
            'category_desc' => 'nullable|string',
        ])->validate();
        $category = Category::findOrFail($id);
        $validated = Arr::except($validated, ['image']);
        $category->update($validated);

        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            $path = 'backend/images/category/';
            imageUploaded($request,$path,$category);
        }
        return response()->json([
            'status' => 'success',
            'message' =>__('backend.Category Updated Successfully!')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);

        if(($category->products->count())>0)
        {
          return response()->json([
            'status' => 'info',
            'message' => __("backend.Category isn't deleted casue there are product under this category. First delete the product!")
        ], 200);
        }
        else
        {
        if($category->image){
            unlink($category->image);
        }
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => __("backend.Category Delete Successfully!")
        ], 200);

        }
    }

    public function typeUpdate(Request $request){

        $category = Category::find($request->category_id);
        $category->type = $request->category_type;
        $category->save();
        return response()->json([
           'status' => 'success',
           'message' =>__("backend.Type Updated Successfully!")
        ]);
    }
}
