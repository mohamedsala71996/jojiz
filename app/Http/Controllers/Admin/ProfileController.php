<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.profile.edit');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.pages.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'display_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();

        $admin = auth()->user();
        $validated = Arr::except($validated, ['image']);
        $admin->update($validated);

        if ($request->hasFile('image')) {

            $path = 'backend/images/profile/';
            imageUploaded($request, $path, $admin);
        }
        Toastr::success(__("frontend.Profile Updated Successfully"));
        return back();
    }

    public function passwordEdit(string $id)
    {
        return view('admin.pages.password.edit');
    }
    public function passwordUpdate(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ])->validate();

        if (!Hash::check($validated['old_password'], Auth::user()->password)) {
            Toastr::error(__("frontend.Current password didn't match"));
            return back();
        }

        try {
            Auth::user()->update([
                'password' => Hash::make($validated['new_password']),
            ]);
        } catch (Exception $e) {
            return "Opps! Something went wrong. Please try again.";
        }

        Toastr::success(__("frontend.Password Updated Successfully"));
        return back();
    }
}
