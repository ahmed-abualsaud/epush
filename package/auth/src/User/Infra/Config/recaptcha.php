<?php

return [
    'site_key' => env('RECAPTCHA_SITE_KEY'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    'domain' => env('RECAPTCHA_DOMAIN', 'localhost'),
    'verify_url' => env('RECAPTCHA_VERIFY_URL', 'https://www.google.com/recaptcha/api/siteverify')
];