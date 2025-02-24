<?php

namespace App\Http\Helpers;

use App\Models\Admin\PaymentCredential;

class PaymentConfigHelper
{
    public static function get($key, $default = null)
    {
        $config = PaymentCredential::where('key', $key)->first();
        if ($config) {
            return $config->value;
        }
        return $config ? $config->value : $default;
    }
}
