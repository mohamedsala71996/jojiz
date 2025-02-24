<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\ChildCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ChildCategoryController extends Controller
{
    public function list()
    {
        $childcategory = ChildCategory::get();
        $data = [
            'childcategory' => $childcategory,
            'base_url' => url('/'),
            'image_path' => '/public/backend/images/childcategory/',
        ];
        return response()->json([
            'message' => 'Child Category List',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subcategory_id' => 'required|integer',
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
        $validated['slug'] = Str::slug($validated['name']);

        $childcategory = ChildCategory::create($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/childcategory/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $childcategory->update([
                'image' => $new_photo_name,
            ]);
        }
        $data = [
            'childcategory' => $childcategory,
            'base_url' => url('/'),
            'image_path' => '/public/backend/images/childcategory/',
        ];

        return response()->json([
            'message' => 'Child Category Created Successfully',
            'data' => $data,
        ]);

    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subcategory_id' => 'required|integer',
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);
        $validated['slug'] = Str::slug($validated['name']);

        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->update($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/childcategory/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $childcategory->update([
                'image' => $new_photo_name,
            ]);
        }
        $data = [
            'category' => $childcategory,
            'base_url' => url('/'),
            'image_path' => '/public/backend/images/childcategory/',
        ];

        return response()->json([
            'message' => 'Child Category Updated Successfully',
            'data' => $data,
        ]);

    }
}
