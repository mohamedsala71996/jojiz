<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class OfferCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offerCollections = Offer::latest('id')->get();

        return view('admin.pages.offer-collection.index', compact('offerCollections'));
    }
    public function create()
    {
        $collectoin = Offer::with('products')->first();

        $products = Product::latest('id')->get();
        return view('admin.pages.offer-collection.create',compact('products'));
    }

    public function show($id)
    {
        $collectoin = Offer::find($id);


        return view('admin.pages.offer-collection.show',compact('collectoin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = Validator::make($request->all(), [
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
            'title' => 'required|string|unique:offers,title',
            'sub_title' => 'nullable|string',
            ])->validate();
        $validated = Arr::except($validated, ['image']);
        $offer = Offer::create($validated);

        //Image upload
        if ($request->hasFile('image')) {
            if ($offer->image) {
                unlink(public_path($offer->image));
            }
            $photo_location = 'backend/images/offer/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $offer->update([
                'image' => 'public/' . $new_photo_location,
            ]);
        }

        if($request->procuctCollection != null) {
            $offer->products()->sync($request->procuctCollection);
        }

        Toastr::success(__('frontend.Collection Successfully!'));
        return redirect()->route('admin.offer.collection.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $offer = Offer::with('products')->findOrFail($id);
        $selectedProduct_ids = $offer->products->pluck('id')->toArray();
        return view('admin.pages.offer-collection.edit', compact('offer','selectedProduct_ids'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = Validator::make($request->all(), [
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $offer = Offer::find($id);
        $offer->update($validated);

        //Image upload
        if ($request->hasFile('image')) {
            if ($offer->image) {
                unlink($offer->image);
            }
            $photo_location = 'backend/images/offer/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->save(public_path($new_photo_location));

            $offer->update([
                'image' => 'public/' . $new_photo_location,
            ]);
        }

        if($request->procuctCollection != null) {
            $offer->products()->sync($request->procuctCollection);
        }

        Toastr::success(__("frontend.Collection Updated Successfully!"));
        return redirect()->route('admin.offer.collection.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $offer = Offer::find($id);
        $offer->products()->detach();
        if ($offer->image != null) {
            unlink($offer->image);
        }
        $offer->delete();
        return response()->json([
           'message' => __('frontend.Offer Collection deleted successfully'),
           'status' => 'success',
        ], 200);
    }

}
