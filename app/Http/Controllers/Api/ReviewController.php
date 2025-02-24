<?php

namespace App\Http\Controllers\Api;

use App\Models\Review;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Api\Helpers as ApiResponse;

class ReviewController extends Controller
{
    public function list(Request $request){

        $reviews =  $reviews = Review::with('user')->where('product_id',$request->product_id)->get()->map(function($review){
            return [
                'product_id'=>$review->product_id,
                'product_name'=>$review->product->product_name,
                'user_name'=>$review->user->name,
                'text'=>$review->text,
                'rating'=>$review->rating,
                'user_image'=>$review->user->image,
                'image'=>$review->image,
                'user'=>$review->user
            ];
        });
        return ApiResponse::list('Review List', $reviews);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => 'required|integer',
            'text'=>'nullable|string',
            'rating'=>'required|max:5|min:1',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ]);
        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated['user_id']= auth()->user()->id;
        $validated = Arr::except($validated, ['image']);

        $review = Review::create($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/review/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $review->update([
                'image' => 'public/'.$new_photo_location,
            ]);
        }

        return ApiResponse::created( 'Thanks for your openion',$review);

    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => 'required|integer',
            'text'=>'nullable|string',
            'rating'=>'required|max:5|min:1',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ]);
        if ($validator->fails()) {
            return ApiResponse::validation( $validator->errors()->all());
        }
        $validated = $validator->validate();
        $validated['user_id']= auth()->user()->id;
        $validated = Arr::except($validated, ['image']);

        $review = Review::findOrFail($id);
        $review->update($validated);
        if ($request->hasFile('image')) {
            $photo_location = 'backend/images/review/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $review->update([
                'image' => 'public/'.$new_photo_location,
            ]);
        }
        return ApiResponse::created( 'Review Updated',$review);

    }
}
