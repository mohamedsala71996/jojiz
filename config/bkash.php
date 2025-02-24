<?php

return [
    "sandbox"         => env("BKASH_SANDBOX", true),
    "bkash_app_key"     => env("BKASH_APP_KEY", "4f6o0cjiki2rfm34kfdadl1eqq"),
    "bkash_app_secret" => env("BKASH_APP_SECRET", "2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b"),
    "bkash_username"      => env("BKASH_USERNAME", "sandboxTokenizedUser02"),
    "bkash_password"     => env("BKASH_PASSWORD", "sandboxTokenizedUser02@12345"),
    "callbackURL"     => env("BKASH_CALLBACK_URL", "http://localhost/shopaholic_seller_web/bkash/callback"),
    "callbackURLApi"     => env("BKASH_CALLBACK_URL", "http://localhost/shopaholic_seller_web/bkash/callback"),
    'timezone'        => 'Asia/Dhaka',
];
