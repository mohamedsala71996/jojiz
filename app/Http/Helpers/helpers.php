<?php

use App\Models\Admin\Admin;
use App\Models\Cart;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

function generate_random_string($length = 12)
{
    $characters       = 'ABCDEFGHJKMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generateUniqueID($length = 6)
{
    // Generate a unique ID and hash it
    $uniqueID = substr(md5(uniqid(mt_rand(), true)), 0, $length);
    return $uniqueID;
}

function imageUploaded($request, $path, $model)
{
    if ($request->hasFile('image')) {

        $seeder_keyword = 'seeder';

        if ($model->image) {
            if ('public/default.png' != $model->image || 'public/dumy.jpg' != $model->image || ! str_contains($model->image, $seeder_keyword)) {

                if (file_exists(public_path($model->image))) {
                    unlink(public_path($model->image));
                }
            }

        }

        $photo_location     = $path;
        $uploaded_photo     = $request->file('image');
        $new_photo_name     = generate_random_string() . '.' . $uploaded_photo->getClientOriginalExtension();
        $new_photo_location = $photo_location . $new_photo_name;
        // Image::make($uploaded_photo)->save(public_path($new_photo_location));

        $file  = Image::make($uploaded_photo)->orientate();
        $width = $file->width();
        $file->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path($new_photo_location), 60, 'webp');

        $model->update([
            'image' => 'public/' . $new_photo_location,
        ]);
    }
}

function imageUpload($request, $table, $path = null, $field_name = 'image')
{
    $image     = $request->file($field_name);
    $name      = generate_random_string() . '.' . $image->getClientOriginalExtension();
    $save_path = $path . $name;

    Image::make($image)->save(public_path($save_path));
    $table->$field_name = $name;
    $table->save();
}
function cartTotal()
{
    return Cart::where('user_id', auth()->user()->id)->get()->sum('total');
}
function cartSubTotal()
{
    return Cart::where('user_id', auth()->user()->id)->get()->sum('total');
}
function wishlistCount()
{
    if (auth()->check()) {
        return App\Models\Wishlist::where('user_id', auth()->id())->count();
    } else {
        return 0;
    }
}
function cartCount()
{
    if (auth()->check()) {
        return App\Models\Cart::where('user_id', auth()->user()->id)->count();
    } else {
        return 0;
    }
}
function productWiseAdvancePaymentAmount()
{

    return Cart::where('user_id', auth()->user()->id)->get()->sum('advance_payment_amount');
}
function get_amount($amount, $precision = null)
{
    if (! is_numeric($amount)) {
        return "Not Number";
    }

    $amount = ($precision) ? number_format($amount, $precision, ".", ",") : number_format($amount, 2, ".", ",");
    return $amount;
}

function updateEnv(array $data)
{
    $envPath = base_path('.env');

    $content = file_get_contents($envPath);

    foreach ($data as $key => $value) {
        $content = preg_replace("/^{$key}=.*/m", "{$key}='{$value}'", $content);
    }

    file_put_contents($envPath, $content);
}
function generate_random_code($length = 6)
{
    $numbers       = '123456789';
    $numbersLength = strlen($numbers);
    $randNumber    = '';
    for ($i = 0; $i < $length; $i++) {
        $randNumber .= $numbers[rand(0, $numbersLength - 1)];
    }
    return $randNumber;
}
function generate_random_string_number($length = 12)
{
    $characters       = '1234567890';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generate_unique_string($table, $column, $length = 10)
{
    do {
        $generate_rand_string = generate_random_string_number($length);
        $unique               = DB::table($table)->where($column, $generate_rand_string)->exists();
        $loop                 = false;
        if ($unique) {
            $loop = true;
        }
        $unique_string = $generate_rand_string;
    } while ($loop);

    return $unique_string;
}

if (! function_exists('getSslCommerzCredentials')) {
    function getSslCommerzCredentials()
    {
        $paymentCredentials = DB::table('payment_credentials')
            ->where('gateway', 'sslcommerz')
            ->first();

        if ($paymentCredentials) {
            $credentials = json_decode($paymentCredentials->credentials, true);
            return $credentials;
        }

        throw new Exception('SSLCommerz credentials not found');
    }
}
function sendNotification($title, $body)
{
    try {
        // Fetch admin and device token
        $admin = Admin::find(1);
        if (! $admin || ! $admin->app_token) {
            throw new Exception("Admin or app token not found.");
        }
        $fcm = $admin->app_token;

                                                                    // Notification details
        $projectId           = 'shopaholic-f3d48';                  // Replace with your actual Firebase project ID
        $credentialsFilePath = public_path('fmc-credentials.json'); // Ensure the file exists

        if (! file_exists($credentialsFilePath)) {
            throw new Exception("Firebase credentials file not found.");
        }

        // Initialize Google Client
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        // Refresh or fetch access token
        if ($client->isAccessTokenExpired()) {
            $accessToken = $client->fetchAccessTokenWithAssertion();
            if (isset($accessToken['error'])) {
                throw new Exception("Error fetching access token: " . $accessToken['error']);
            }
        }

        $token       = $client->getAccessToken();
        $accessToken = $token['access_token'] ?? null;
        if (! $accessToken) {
            throw new Exception("Access token could not be retrieved.");
        }

        // Prepare headers
        $headers = [
            "Authorization: Bearer $accessToken",
            'Content-Type: application/json',
        ];

        // Prepare notification payload
        $data = [
            "message" => [
                "token"        => $fcm, // FCM device token
                "notification" => [
                    "title" => $title,
                    "body"  => $body,
                ],
            ],
        ];

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Execute the request
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        curl_close($ch);

        if ($err) {
            throw new Exception("cURL Error: $err");
        }

        // Decode response
        $decodedResponse = json_decode($response, true);
        if (isset($decodedResponse['error'])) {
            throw new Exception("FCM Error: " . $decodedResponse['error']['message']);
        }

        return $decodedResponse; // Success response
    } catch (Exception $e) {
        // Handle errors
        return [
            'success' => false,
            'message' => $e->getMessage(),
        ];
    }
}
