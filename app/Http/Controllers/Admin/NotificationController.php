<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class NotificationController extends Controller
{
    protected $new_photo_location;
    public function index()
    {
        $notifications = Notification::where('type','order')->get();
        return view('admin.pages.notification.index',compact('notifications'));
    }
    public function create()
    {

        return view('admin.pages.notification.create');
    }

    public function SendNotification(Request $request)
    {

        $request->validate([
            'user_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:5048',
            'link' => 'nullable|url|max:255',
            'url' => 'nullable|url|max:255',
        ]);

        $users = [];
        switch ($request->user_type) {
            case "all";
                $users = User::get();
                break;
            case "new_user";
                $sevenDaysAgo = Carbon::now()->subDays(7);
                $users = User::where('created_at', '>=', $sevenDaysAgo)->get();
                break;
        }

        try {

            if ($request->hasFile('image')) {
                $photo_location = 'backend/images/notification/';
                $uploaded_photo = $request->file('image');
                $new_photo_name = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
                $this->new_photo_location = $photo_location . $new_photo_name;
                Image::make($uploaded_photo)->save(public_path($this->new_photo_location));

                // $notification->update([
                //     'image' => 'public/' . $new_photo_location,
                // ]);
            }


            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => 'public/' . $this->new_photo_location,
                    'link' => $request->link,
                    'url' => $request->url,
                    'type'=>'superadminnotification'
                ]);
            }

        } catch (Exception $e) {

            Toastr::error('Something Went Wrong, Please Try Again');
            return back();
        }

        Toastr::success(__('frontend.Notification Send Successfully!'));
        return back();
    }
}
