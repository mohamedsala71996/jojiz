<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\MailSetting;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $webinfo = GeneralSetting::first();
        return view('admin.pages.general-setting.web-setting', ['webinfo' => $webinfo]);
    }

    public function mailConfigPage()
    {
        $mailSettings = MailSetting::first();
        return view('admin.pages.mail-configaration.create', compact('mailSettings'));
    }

    public function mailConfigUpdate(Request $request)
    {
        // Validate the incoming request data

        $validated = Validator::make($request->all(), [
            'MAIL_MAILER' => 'required|string|max:255',
            'MAIL_HOST' => 'required|string|max:255',
            'MAIL_PORT' => 'required|integer',
            'MAIL_USERNAME' => 'required|string|max:255',
            'MAIL_PASSWORD' => 'required|string|max:255',
            'MAIL_ENCRYPTION' => 'required|string|max:255',
        ])->validate();
        $mailSetting = MailSetting::first();
        $mailSetting->update($validated);

        // // Prepare the data to update in .env file
        $data = [
            'MAIL_HOST' => $mailSetting->MAIL_HOST,
            'MAIL_PORT' => $mailSetting->MAIL_PORT,
            'MAIL_USERNAME' => $mailSetting->MAIL_USERNAME,
            'MAIL_PASSWORD' => $mailSetting->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $mailSetting->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $mailSetting->MAIL_USERNAME,
            'MAIL_FROM_NAME' => $basic_setting->site_name ?? env("APP_NAME"),
        ];

        // Call the helper function to update .env file
        updateEnv($data);

        // Optionally, clear the config cache to ensure changes take effect immediately
        Artisan::call('config:clear');

        Toastr::success(__('frontend.Mail configuration updated successfully!'));
        return redirect()->back();

    }

    public function metatag(Request $request, $id)
    {
        $webinfo = GeneralSetting::where('id', $id)->first();
        $webinfo->meta_title = $request->meta_title;
        $webinfo->meta_description = $request->meta_description;
        $webinfo->meta_keyword = $request->meta_keyword;
        if ($request->meta_image) {
            $logo = $request->file('meta_image');
            $name = time() . "_" . $logo->getClientOriginalName();
            $uploadPath = ('public/images/categorybanner/');
            $logo->move($uploadPath, $name);
            $logoImgUrl = $uploadPath . $name;
            $webinfo->meta_image = $logoImgUrl;
        }
        $webinfo->update();
        Toastr::success(__('frontend.Meta info updated successfully'));
        return redirect()->back();
    }

    public function updatesite(Request $request, $id)
    {
        $webinfo = GeneralSetting::where('id', $id)->first();
        $webinfo->email = $request->email;
        $webinfo->phone = $request->phone;
        $webinfo->address = $request->address;
        $webinfo->cash_on_delivery = $request->cash_on_delivery;
        $webinfo->online_payment = $request->online_payment;
        $webinfo->vat = $request->vat;
        $webinfo->vat_status = $request->vat_status;
        $webinfo->tax = $request->tax;
        $webinfo->tax_status = $request->tax_status;
        $webinfo->advance_payment = $request->advance_payment;
        $webinfo->advance_payment_status = $request->advance_payment_status;
        $webinfo->advance_payment_title = $request->advance_payment_title;
        $webinfo->advance_payment_type = $request->advance_payment_type;
        $webinfo->delivary_charge = $request->delivary_charge;
        $webinfo->delivery_charge_type = $request->delivery_charge_type;
        $webinfo->update();
        Toastr::success(__('frontend.Web settings updated successfully'));
        return redirect()->back();
    }

    public function pixelanalytics(Request $request, $id)
    {
        $webinfo = GeneralSetting::where('id', $id)->first();
        if ($request->facebook_pixel) {
            $webinfo->facebook_pixel = $request->facebook_pixel;
        } else {
            $webinfo->facebook_pixel = '';
        }
        if ($request->google_analytics) {
            $webinfo->google_analytics = $request->google_analytics;
        } else {
            $webinfo->google_analytics = '';
        }
        if ($request->chat_box) {
            $webinfo->chat_box = $request->chat_box;
        } else {
            $webinfo->chat_box = '';
        }
        $webinfo->update();
        Toastr::success(__("frontend.Pixel & Analytics updated successfully"));
        return redirect()->back();
    }

    public function sociallink(Request $request, $id)
    {
        $webinfo = GeneralSetting::where('id', $id)->first();
        if (isset($request->facebook)) {
            $webinfo->facebook = $request->facebook;
        } else {
            $webinfo->facebook = null;
        }
        if (isset($request->twitter)) {
            $webinfo->twitter = $request->twitter;
        } else {
            $webinfo->twitter = null;
        }
        if (isset($request->google)) {
            $webinfo->google = $request->google;
        } else {
            $webinfo->google = null;
        }
        if (isset($request->rss)) {
            $webinfo->rss = $request->rss;
        } else {
            $webinfo->rss = null;
        }
        if (isset($request->pinterest)) {
            $webinfo->pinterest = $request->pinterest;
        } else {
            $webinfo->pinterest = null;
        }
        if (isset($request->linkedin)) {
            $webinfo->linkedin = $request->linkedin;
        } else {
            $webinfo->linkedin = null;
        }
        if (isset($request->youtube)) {
            $webinfo->youtube = $request->youtube;
        } else {
            $webinfo->youtube = null;
        }
        $webinfo->update();
        Toastr::success(__('frontend.Social Links updated successfully'));
        return redirect()->back();
    }
    public function appDownload(Request $request, $id)
    {

        $webinfo = GeneralSetting::where('id', $id)->first();
        if (isset($request->app_store)) {
            $webinfo->app_store = $request->app_store;
        } else {
            $webinfo->app_store = null;
        }
        if (isset($request->apple_store)) {
            $webinfo->apple_store = $request->apple_store;
        } else {
            $webinfo->apple_store = null;
        }

        $webinfo->update();
        Toastr::success(__('frontend.Updated successfully'));
        return redirect()->back();
    }

    public function basicSetting()
    {
        return view('admin.pages.general-setting.basic-setting');
    }
    public function basicSettingUpdate(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'site_name' => 'required|string',
            'site_title' => 'required|string',
            'web_version' => 'required|string',
        ])->validate();

        try {
            $general_setting = GeneralSetting::first();
            $general_setting->update($validated);
        } catch (Exception $e) {
            return 'Oops! Somethig went wrong. Please try again';
        }
        Toastr::success(__('frontend.Basic Setting Updated Successfully!'));
        return back();
    }
    public function imageAsset()
    {
        return view('admin.pages.general-setting.image-asset');
    }
    public function imageAssetUpdate(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'site_logo' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();

        try {
            $general_setting = GeneralSetting::first();
            $path = "backend/images/general-setting/";
            imageUpload($request, $general_setting, $path, 'site_logo');
        } catch (Exception $e) {
            return 'Oops! Something went wrong. Please try again';
        }
        Toastr::success(__('frontend.Basic Setting Updated Successfully!'));
        return back();
    }
    public function faviconUpdate(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'site_favicon' => 'required|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();

        try {
            $general_setting = GeneralSetting::first();
            $path = "backend/images/general-setting/";
            imageUpload($request, $general_setting, $path, 'site_favicon');
        } catch (Exception $e) {
            return 'Oops! Something went wrong. Please try again';
        }
        Toastr::success(__('frontend.Basic Setting Updated Successfully!'));
        return back();
    }

}
