<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'MAIL_MAILER' => 'string',
        'MAIL_HOST' => 'string',
        'MAIL_PORT' => 'integer',
        'MAIL_USERNAME' => 'string',
        'MAIL_PASSWORD' => 'string',
        'MAIL_ENCRYPTION' => 'string',
        'MAIL_FROM_ADDRESS' => 'string',
        'MAIL_FROM_NAME' => 'string',
    ];
}
