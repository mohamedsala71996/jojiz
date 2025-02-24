<?php

namespace App\Http\Controllers\Admin;


use Exception;
use DataTables;
use Illuminate\Support\Arr;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::orderBy('id','desc')->get();
        return view('admin.pages.faq.index',compact('faqs'));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
        ])->validate();

        try {
            $slider = FAQ::create($validated);

        } catch (Exception $e) {

            return "Oops! Something went wrong. Please try again";
        }
        Toastr::success(__("frontend.FAQ Created Successfully!"));
        return redirect()->route('admin.faqs.index');
    }
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        return response()->json($faq, 200);
    }
    public function update(Request $request,string $id)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
        ])->validate();
        $faq = FAQ::findOrFail($id);
        $faq->update($validated);

        Toastr::success(__("frontend.FAQ Updated Successfully"));
        return response()->json([
            'status' => 'success',
            'message' => __("frontend.FAQ Updated Successfully")
         ]);
    }
    public function destroy(string $id)
    {
        $faq = FAQ::findOrFail($id);

        $faq->delete();
        Toastr::success(__('frontend.FAQ Delete Successfully'));
        return response()->json([
            'status' => 'success',
            'message' => __('frontend.FAQ Delete Successfully')
         ]);
    }
}
