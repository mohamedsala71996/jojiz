<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Brand;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class BrandController extends Controller
{
    public function list()
    {
        $brand = Brand::paginate(12);
        return ApiResponse::list('Brand List', $brand);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'desc' => 'required|string',
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

        $brand = Brand::create($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/brand/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $brand->update([
                'image' => 'public/'.$new_photo_location,
            ]);
        }
        $data = [
            'brand'=>$brand,
            'base_url'=>url('/'),
            'image_path'=>'/public/backend/images/brand/',
        ];

        return response()->json([
            'message'=>'Brand Created Successfully',
            'data'=>$data
        ]);

    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|string',
            'desc' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
            ], 422);
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);
        $validated['slug'] = Str::slug($validated['name']);

        $brand = Brand::findOrFail($id);
        $brand->update($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/brand/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $brand->update([
                'image' => 'public/'.$new_photo_location,
            ]);
        }
        $data = [
            'brand'=>$brand,
            'base_url'=>url('/'),
            'image_path'=>'/public/backend/images/brand/',
        ];

        return response()->json([
            'message'=>'Brand Updated Successfully',
            'data'=>$data
        ]);

    }
}
