<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class ProfileController extends Controller
{

    public function profileDetails()
    {
        $user = auth()->user();
        return ApiResponse::list('Profile Details', $user);
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'nullable',
            'birthday' => 'nullable',
            'email' => 'required|email',
            'phone' => 'nullable',
            'country' => 'nullable',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validation($validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated = Arr::except($validated, ['image']);
        $user = auth()->user();

        $user->update($validated);

        if ($request->hasFile('image')) {
            $path = 'frontend/images/user/';
            imageUploaded($request, $path, $user);
        }
        return ApiResponse::created('Profile Updated Successfully', $user);

    }
}
