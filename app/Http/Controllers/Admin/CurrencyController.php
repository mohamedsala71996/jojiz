<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Currency;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CurrencyController extends Controller
{

    public function edit(Currency $currency)
    {
        $admins = Admin::get();

        return view('admin.currency.edit', compact('currency', 'admins'));
    }

    public function update(Request $request, Currency $currency)
    {

        $validated = Validator::make($request->all(), [
            'country' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:20',
            'symbol' => 'required|string|max:20',
            'symbol_position' => 'required|string',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
            'rate' => 'nullable|numeric|min:0',
        ])->validate();

        $validated['admin_id'] = 1;
        $validated = Arr::except($validated, ['image']);

        try {
            $currency->update($validated);
            if ($request->hasFile('image')) {

                $photo_location = 'backend/images/currency/';
                imageUploaded($request,$photo_location,$currency);
            }
        } catch (Exception $e) {

            return __("frontend.Opps! Someting went wrong.Please try again.");
        }
        Toastr::success(__('frontend.Currency Updated Successfully!'));

        return back();
    }

    public function destroy(Currency $currency)
    {
        if($currency->image){
            unlink($currency->image);
        }
        $currency->delete();

        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully.');
    }

    public function setDefault(Currency $currency)
    {
        Currency::query()->update(['default' => false]); // Unset previous default currency
        $currency->update(['default' => true]); // Set new default currency

        return redirect()->route('currencies.index')->with('success', 'Default currency set successfully.');
    }
}
