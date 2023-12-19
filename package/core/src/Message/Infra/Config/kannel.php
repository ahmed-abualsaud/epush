<?php

return [
    'kannel_server_url' => env('KANNEL_HOST_URL', 'http://localhost:13013/cgi-bin/sendsms'),
    'kannel_username' => env('KANNEL_USERNAME', 'epush'),
    'kannel_password' => env('KANNEL_PASSWORD', 'I78S4M56'),
    'kannel_sms_charset' => env('KANNEL_SMS_CHARSET', 'UTF-8'),
    'kannel_sms_encoding' => env('KANNEL_SMS_ENCODING', '2'),
    'kannel_dlr_mask' => env('KANNEL_DLR_MASK', '31'),
];