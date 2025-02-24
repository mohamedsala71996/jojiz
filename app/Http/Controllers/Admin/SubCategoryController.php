<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{

    public function index()
    {
        $categoris = Category::get();
        $data = SubCategory::orderBy('id', 'desc')->get();

        return view('admin.pages.subcategory.index', compact('categoris'));
    }
    public function subCategoryAjraTable(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::orderBy('id', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="dropdown-product-list">
                            <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                            <div id="myDropdown" class="dropdown-product-list-content">

                              <a type="button" class="label rounded"
                            href="javascript:void(0)" id="subCategoryEdit" data-id="' . $data->id . '"><span
                                ><i
                                  class="fa-solid fa-pen-to-square mr-1"
                                ></i
                              ></span>' . __('backend.Edit') . '</a>

                                <a  type="button" class="label rounded confirmDelete" data-id="' . $data->id . '" id="subCategoryDelete" href="javascript:void(0)"><span
                                    ><i
                                    class="fa-regular fa-trash-can mr-1"
                                    ></i
                                ></span>'.__('backend.Delete').'</a>

                            </div>
                          </div>';
                    return $btn;
                })
                ->addColumn('category', function ($data) {
                    return $data->category->category_name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);

        try {
            $subcategory = SubCategory::create($validated);

            if ($request->hasFile('image')) {
                $path = 'backend/images/sub-category/';
                imageUploaded($request, $path, $subcategory);
            }
        } catch (Exception $e) {

            return "Oops! Something went wrong. Please try again";
        }
        Toastr::success(__("frontend.Sub Category Created Successfully!"));
        return back();
    }
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        return response()->json([
            'category' => $subcategory->category->id,
            'category_id' => $subcategory->category_id,
            'subcategory' => $subcategory->name,
            'subcat_id' => $subcategory->id,
            'image' => $subcategory->image,
        ], 200);
    }
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($validated);

        if ($request->hasFile('image')) {

            $photo_location = 'backend/images/sub-category/';
            imageUploaded($request, $photo_location, $subcategory);
        }

        return response()->json([
            'status' => 'success',
            'message' => __("frontend.Sub Category Updated Successfully!"),
        ]);
    }
    public function destroy($subcategory_id)
    {
        $subcategory = SubCategory::findOrFail($subcategory_id);

        if ($subcategory->image) {
            unlink($subcategory->image);
        }
        $subcategory->delete();
        return response()->json([
            'status' => 'success',
            'message' =>__("frontend.Sub Category Delete Successfully!"),
        ], 200);
    }
}
