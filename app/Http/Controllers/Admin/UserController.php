<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Arr;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function index(){
        $users = User::latest('id')->get();
        return view('admin.pages.user-list.index',compact('users'));
    }
    function edit($id){
        $data = User::findOrFail($id);
        return view('admin.pages.user-list.edit',compact('data'));
    }
    function update(Request $request, $id){

        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'location' => 'nullable',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
        ])->validate();
        $validated = Arr::except($validated, ['image']);
        $user = User::findOrFail($id);

        $user->update($validated);

        if ($request->hasFile('image')) {

            $path = 'frontend/images/user/';
            imageUploaded($request,$path,$user);
        }

        Toastr::success(__('backend.Customer Info Updated Successfully'));

        return redirect()->route('admin.user.list.index');

    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.csv');
    }
}
