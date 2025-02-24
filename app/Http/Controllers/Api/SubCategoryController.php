<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Api\Helpers as ApiResponse;
use App\Models\Admin\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function list($category_id = null)
    {
        $query = SubCategory::query();
        if ($category_id) {
            $query->where('category_id', $category_id)->get();
        }
        $subcategory = $query->get();
        return ApiResponse::list('Sub Category List', $subcategory);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);

        $subcategory = SubCategory::create($validated);
        if ($request->hasFile('image')) {

            $photo_location = 'backend/images/sub-category/';
            imageUploaded($request, $photo_location, $subcategory);
        }
        $data = [
            'subcategory' => $subcategory,
            'base_url' => url('/'),
            'image_path' => '/public/backend/images/sub-category/',
        ];

        return response()->json([
            'message' => 'Sub Category Created Successfully',
            'data' => $data,
        ]);

    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/sub-category/';
                imageUploaded($request,$photo_location,$subcategory);
        }
        $data = [
            'category' => $subcategory,
            'base_url' => url('/'),
            'image_path' => '/public/backend/images/sub-category/',
        ];

        return response()->json([
            'message' => 'Sub Category Updated Successfully',
            'data' => $data,
        ]);

    }
}
