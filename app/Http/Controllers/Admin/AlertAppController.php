<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\AlertApp;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AlertAppController extends Controller
{
    public function edit(AlertApp $alertApp)
    {
        return view('admin.pages.alert_app.edit', compact('alertApp'));
    }
    public function update(Request $request, AlertApp $alertApp)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'discount' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
            'expire_time' => 'nullable',
            'link' => 'nullable',
            'active' => 'required|string|max:255', // Adjust validation rule as needed
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        try{
            $alertApp->update($validated);

        if ($request->hasFile('image')) {

            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/alert/';
                imageUploaded($request,$photo_location,$alertApp);
            }
        }
        }catch(Exception $e){
            
            Toastr::error(__('frontend.Something went worng! Please try again.'));
        }

        Toastr::success(__("frontend.Alert Updated Successfully!"));

        return back();
    }
}
