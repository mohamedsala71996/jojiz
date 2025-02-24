<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couriers = Courier::all();
        return view('admin.pages.courier.index', compact('couriers'));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'courierName' => 'required|string|unique:categories,category_name',
            'charge'      => 'required',
            'available'   => 'required',
            'image'       => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        try {
            $courier = Courier::create($request->all());

            if ($request->hasFile('image')) {
                $path = 'backend/images/courier/';
                imageUploaded($request, $path, $courier);
            }
        } catch (Exception $e) {

            return __("frontend.Opps! Someting went wrong.Please try again.");
        }

        Toastr::success(__("frontend.Courier Insert Successfully!"));
        return back();
        // return redirect()->route('admin.couriers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courier = Courier::findOrfail($id);

        return response()->json($courier, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'courierName' => 'required|string|unique:categories,category_name',
            'charge'      => 'required',
            'available'   => 'required',
            'image'       => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $courier   = Courier::findOrFail($id);
        $validated = Arr::except($validated, ['image']);
        $courier->update($validated);

        $courier = Courier::findOrFail($id);
        if ($request->hasFile('image')) {
            $path = 'backend/images/courier/';
            imageUploaded($request, $path, $courier);
        }
        return response()->json([
            'status'  => 'success',
            'message' => __('backend.Courier Updated Successfully!'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courier = Courier::findOrfail($id);
        if ($courier->image) {
            unlink($courier->image);
        }
        $courier->delete();

        return response()->json([
            'status'  => 'success',
            'message' => __('backend.Courier Delete Successfully!'),
        ], 200);
    }

    public function updatestatus(Request $request)
    {

        $courier         = Courier::Where('id', $request->courier_id)->first();
        $courier->status = $request->status;
        $courier->update();

        return response()->json([
            'status'  => 'success',
            'message' => __('backend.Courier Status Updated!'),
        ], 200);
    }

}
