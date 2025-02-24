<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DataTables;
use Illuminate\Support\Arr;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('id','desc')->get();
        return view('admin.pages.slider.index',compact('sliders'));
    }
    public function sliderajraTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::orderBy('id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="dropdown-product-list">
                            <button><i class="bi bi-three-dots dropdown-product-list"></i></button>
                            <div id="myDropdown" class="dropdown-product-list-content">

                              <a type="button" class="label rounded"
                            href="javascript:void(0)" id="sliderEdit" data-id="' . $data->id . '"><span
                                ><i
                                  class="fa-solid fa-pen-to-square mr-1"
                                ></i
                              ></span>' . __('backend.Edit') . '</a>

                                <a  type="button" class="label rounded confirmDelete" data-id="' . $data->id . '" id="sliderDelete" href="javascript:void(0)"><span
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

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'sub_heading' => 'nullable|string',
            'heading' => 'nullable|string',
            'desc' => 'nullable',
            'starting_amount' => 'nullable|integer',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'heading' => 'nullable|string',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);

        try {
            $slider = Slider::create($validated);

            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/slider/';
                imageUploaded($request,$photo_location,$slider);
            }
        } catch (Exception $e) {

            return "Oops! Something went wrong. Please try again";
        }
        Toastr::success(__('frontend.Slider Created Successfully!'));
        return back();
    }
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return response()->json($slider, 200);
    }
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'sub_heading' => 'nullable|string',
            'heading' => 'nullable|string',
            'desc' => 'nullable',
            'starting_amount' => 'nullable',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'heading' => 'nullable|string',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $slider = Slider::findOrFail($id);
        $slider->update($validated);

        if ($request->hasFile('image')) {

            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/slider/';
                imageUploaded($request,$photo_location,$slider);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' =>__("frontend.Slider Updated Successfully!")
        ]);
    }
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if($slider->image){
            unlink($slider->image);
        }
        $slider->delete();
        return response()->json([
            'status' => 'success',
            'message' => __("frontend.Slider Delete Successfully!")
        ], 200);
    }
}
