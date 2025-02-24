<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UsefulLink;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsefulLinkController extends Controller
{

    public function index()
    {
        $usefullinks = UsefulLink::get();
        return view('admin.pages.usefullink.index', compact('usefullinks'));
    }

    public function create()
    {

        return view('admin.pages.usefullink.create');
    }
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ])->validate();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['type'] = 'page';
        $validated['url'] = '#';
        try {
            $usefullink = UsefulLink::create($validated);

        } catch (Exception $e) {

            return "Oops! Something went wrong. Please try again";
        }
        Toastr::success(__("frontend.Created Successfully!"));
        return redirect()->route('admin.usefullink.index');
    }

    public function edit($id)
    {
        $usefullink = UsefulLink::findOrFail($id);
        return view('admin.pages.usefullink.edit', compact('usefullink'));

    }
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ])->validate();

        try {
            $usefullink = UsefulLink::findOrFail($id);
            $validated['slug'] = Str::slug($validated['title']);
            $validated['type'] = 'page';
            $validated['url'] = '#';
            $usefullink->update($validated);
        } catch (Exception $e) {
            return "Oops! Something went wrong. Please try again";
        }

        Toastr::success(__("frontend.Updated Successfully"));
        return redirect()->route('admin.usefullink.index');
    }
    public function destroy(string $id)
    {
        $usefullink = UsefulLink::findOrFail($id);

        $usefullink->delete();
        Toastr::success(__('frontend.Delete Successfully'));
        return response()->json([
            'status' => 'success',
            'message' => __('frontend.Delete Successfully'),
        ]);
    }

    public function editPrivacyPolicy($privacyPolicy)
    {
        $privacyPolicy = UsefulLink::where('slug', $privacyPolicy)->first();

        return view('admin.pages.usefullink.edit-privacy-policy', compact('privacyPolicy'));
    }

    public function updatePrivacyPolicy(Request $request, $privacyPolicy)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ])->validate();

        $validated['slug'] = Str::slug($validated['title']);

        $privacyPolicy = UsefulLink::where('slug', $privacyPolicy)->first();
        $privacyPolicy->update($validated);

        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }
    public function editReturnPolicy($returnPolicy)
    {
        $returnPolicy = UsefulLink::where('slug', $returnPolicy)->first();

        return view('admin.pages.usefullink.edit-return-policy', compact('returnPolicy'));
    }

    public function updateReturnPolicy(Request $request, $privacyPolicy)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ])->validate();

        $validated['slug'] = Str::slug($validated['title']);

        $privacyPolicy = UsefulLink::where('slug', $privacyPolicy)->first();
        $privacyPolicy->update($validated);

        Toastr::success(__('frontend.Updated successfully'));
        return back();
    }

}
