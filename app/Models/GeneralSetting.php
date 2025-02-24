<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'site_name' => 'string',
        'site_title' => 'string',
        'web_version' => 'string',
        'site_logo' => 'string',
        'site_favicon' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'address' => 'string', // Cast text fields as string
        'facebook_pixel' => 'string',
        'google_analytics' => 'string',
        'chat_box' => 'string',
        'delivary_charge' => 'string',
        'vat' => 'float', // Cast as float with precision defined in migration
        'vat_status' => 'string', // Default value is 'OFF'
        'tax' => 'float', // Cast as float with precision defined in migration
        'tax_status' => 'string', // Default value is 'OFF'
        'cash_on_delivery' => 'string', // Default value is 'ON'
        'online_payment' => 'string', // Default value is 'ON'
        'facebook' => 'string',
        'twitter' => 'string',
        'google' => 'string',
        'rss' => 'string',
        'pinterest' => 'string',
        'linkedin' => 'string',
        'youtube' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'meta_keyword' => 'string',
        'meta_image' => 'string',
    ];
}
