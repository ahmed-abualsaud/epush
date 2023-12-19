<?php

return [
    // 'sms_server_url' => env('SMS_HOST_URL', 'https://api.epusheg.com/api/v2/send_bulk'),
    // 'sms_username' => env('SMS_USERNAME', 'pass@epushagency.com'),
    // 'sms_password' => env('SMS_PASSWORD', 'NrkmSgby'),
    // 'sms_api_key' => env('SMS_API_KEY', 'SwKh-w8xJ-qRv8-7XUm'),
    // 'sms_from' => env('SMS_FROM', 'E push'),

    'kannel_server_url' => env('KANNEL_HOST_URL', 'http://localhost:13013/cgi-bin/sendsms'),
    'kannel_username' => env('KANNEL_USERNAME', 'epush'),
    'kannel_password' => env('KANNEL_PASSWORD', 'I78S4M56'),
    'kannel_sms_charset' => env('KANNEL_SMS_CHARSET', 'UTF-8'),
    'kannel_sms_encoding' => env('KANNEL_SMS_ENCODING', '2'),
    'kannel_dlr_mask' => env('KANNEL_DLR_MASK', '31'),
    'kannel_default_smsc' => env('KANNEL_DEFAULT_SMSC', 'ceqvf'),
    'kannel_default_sender_name' => env('KANNEL_DEFAULT_SENDER_NAME', 'E-Push'),
];