<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function brandAjraTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="dropdown-product-list">
                            <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                            <div id="myDropdown" class="dropdown-product-list-content">
                              <a type="button" class="label rounded"
                              href="javascript:void(0)" data-details="' . $data->desc . '" id="brandDetails"><span
                                ><i class="fa-regular fa-eye mr-1"></i
                              ></span>' . __('backend.Details') . '</a>

                              <a type="button" class="label rounded"
                            href="javascript:void(0)" id="brandedit" data-id="' . $data->id . '"><span
                                ><i
                                  class="fa-solid fa-pen-to-square mr-1"
                                ></i
                              ></span>' . __('backend.Edit') . '</a>

                                <a  type="button" class="label rounded confirmDelete" data-id="' . $data->id . '" id="categoryDelete" href="javascript:void(0)"><span
                                    ><i
                                    class="fa-regular fa-trash-can mr-1"
                                    ></i
                                ></span>'.__('backend.Delete').'</a>

                            </div>
                          </div>';
                    return $btn;
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
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();

        $validated['slug'] = Str::slug($validated['name']);
        $validated = Arr::except($validated, ['image']);

        try {
            $brand = Brand::create($validated);
            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/brand/';
                $uploaded_photo = $request->file('image');
                $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
                $new_photo_location = $photo_location . $new_photo_name;
                Image::make($uploaded_photo)->save(public_path($new_photo_location));

                $brand->update([
                    'image' => 'public/' . $new_photo_location,
                ]);
            }
        } catch (Exception $e) {

            return __("frontend.Opps! Someting went wrong.Please try again.");
        }
        Toastr::success(__("frontend.Brand Created Successfully!"));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Brand::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'desc' => 'required|string',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $brand = Brand::findOrFail($id);
        $brand->update($validated);
        if ($request->hasFile('image')) {
            if ('default.png' != $brand->image) {
                $photo_location = 'backend/images/brand/' . $brand->image;
            }
            $photo_location = 'backend/images/brand/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $brand->update([
                'image' => 'public/' . $new_photo_location,
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' =>__('backend.Brand Updated Successfully!'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Brand::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('backend.Brand Delete Successfully!'),
        ], 200);
    }
}
