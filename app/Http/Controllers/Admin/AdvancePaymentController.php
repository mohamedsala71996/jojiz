<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdvancePaymentController extends Controller
{
    public function edit()
    {
        $webinfo = GeneralSetting::first();
        return view('admin.advance-payment.edit', compact('webinfo'));
    }

    public function update(Request $request)
    {
        $webinfo = GeneralSetting::first();
        $webinfo->advance_payment = $request->advance_payment;
        $webinfo->advance_payment_status = $request->advance_payment_status;
        $webinfo->advance_payment_title = $request->advance_payment_title;
        $webinfo->advance_payment_type = $request->advance_payment_type;

        $webinfo->update();
        Toastr::success(__('backend.Advance Payment Updated Successfully'));
        return redirect()->back();
    }
}
