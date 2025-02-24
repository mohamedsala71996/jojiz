<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class CategoryController extends Controller
{
    public function list()
    {
        $category = Category::active()->get();
        return ApiResponse::success('Category List', $category);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|unique:categories,category_name',
            'category_desc' => 'required|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);
        $validated['category_slug'] = Str::slug($validated['category_name']);

        $category = Category::create($validated);
        if ($request->hasFile('image')) {
            $path = 'backend/images/category/';
            imageUploaded($request,$path,$category);
        }
        return ApiResponse::success('Category Created Successfully', $category);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',
            'category_desc' => 'required|string',
        ]);
        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);
        $validated['category_slug'] = Str::slug($validated['category_name']);

        $category = Category::findOrFail($id);
        $category->update($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/category/';
            imageUploaded($request,$photo_location,$category);
        }

        return response()->json([
            'message'=>'Category Updated Successfully',
            'data'=>$category
        ]);

    }
}
