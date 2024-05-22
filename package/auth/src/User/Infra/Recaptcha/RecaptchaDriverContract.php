<?php

namespace Epush\Auth\User\Infra\Recaptcha;

interface RecaptchaDriverContract
{
    public function validatTokenOrFail(string $token): bool;
}