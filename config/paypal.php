<?php
return [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // sandbox or live
    'sandbox' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    ],
    'live' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    ],
    'payment_action' => 'sale',
    'currency' => 'USD',
    'notify_url' => 'your_notify_url', // Your IPN notification URL
    'locale' => 'en_US',
];
