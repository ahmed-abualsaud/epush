<?php

namespace Epush\Auth\User\Infra\Recaptcha;

use Illuminate\Support\Facades\Http;

class RecaptchaDriver implements RecaptchaDriverContract
{
    public function validatTokenOrFail(string $token): bool
    {
        $response = Http::asForm()->post(config('recaptcha.verify_url'), [
            'response' => $token,
            'secret' => config('recaptcha.secret_key'),
            'remoteip' => config('recaptcha.domain')
        ]);

        if ($response->successful() && $response->json()['success']) {
            return $response->json()['success'];
        } else {
            throwHttpException(400, 'Invalid recaptcha token');
        }
    }
}