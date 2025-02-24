<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ChildCategory;
use App\Models\Admin\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subcategories = SubCategory::orderBy('id', 'desc')->get();
        return view('admin.pages.childcategory.index', compact('subcategories'));
    }
    public function childcategoryajraTable(Request $request)
    {
        if ($request->ajax()) {
            $data = ChildCategory::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="dropdown-product-list">
                            <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                            <div id="myDropdown" class="dropdown-product-list-content">
                              <a type="button" class="label rounded"
                            href="javascript:void(0)" id="childcategoryedit" data-id="' . $data->id . '"><span
                                ><i
                                  class="fa-solid fa-pen-to-square mr-1"
                                ></i
                              ></span>' . __('backend.Edit') . '</a>

                                <a  type="button" class="label rounded confirmDelete" data-id="' . $data->id . '" id="childcategorydelete" href="javascript:void(0)"><span
                                    ><i
                                    class="fa-regular fa-trash-can mr-1"
                                    ></i
                                ></span>'.__('backend.Delete').'</a>

                            </div>
                          </div>';
                    return $btn;
                })
                ->addColumn('subcategory', function ($data) {
                    return $data->subcategory->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->file('image'));
        $validated = Validator::make($request->all(), [
            'subcategory_id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated['slug'] = Str::slug($validated['name']);
        $validated = Arr::except($validated, ['image']);

        try {
            $childcategory = ChildCategory::create($validated);
            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/childcategory/';
                imageUploaded($request,$photo_location,$childcategory);
            }
        } catch (Exception $e) {

            return __("frontend.Opps! Someting went wrong.Please try again.");
        }
        Toastr::success(__('frontend.Child Category Created Successfully!'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $childcategory = ChildCategory::findOrFail($id);
        return response()->json([
            'subcategory' => $childcategory->subcategory->id,
            'subcategory_id' => $childcategory->subcategory_id,
            'name' => $childcategory->name,
            'childcat_id' => $childcategory->id,
            'image' => $childcategory->image,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'subcategory_id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->update($validated);

        if ($request->hasFile('image')) {
            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/childcategory/';
                imageUploaded($request,$photo_location,$childcategory);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' =>__("backend.Child Category Updated Successfully!") ,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $chaildcategory = ChildCategory::findOrFail($id);
        if($chaildcategory->image){
            unlink($chaildcategory->image);
        }
        $chaildcategory->delete();
        return response()->json([
            'status' => 'success',
            'message' =>__("backend.Child Category Delete Successfully!"),
        ], 200);
    }
}
