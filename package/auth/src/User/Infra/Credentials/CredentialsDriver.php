<?php

namespace Epush\Auth\User\Infra\Credentials;

use Ichtrojan\Otp\Otp;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CredentialsDriver implements CredentialsDriverContract
{
    public function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    public function checkPassword(string $password, string $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }

    public function validateOtp(string $identifier, string $token): array
    {
        return (array) (new Otp)->validate($identifier, $token);
    }

    public function generateOtp(string $identifier): array
    {
        return (array) (new Otp)->generate($identifier, 'numeric', 4, 15);
    }

    public function generatePassword(): string
    {
        return Str::password(12, true, true, true, false);
    }

    public function attemptOrFail(string $username, string $password): string
    {
        if (! $token = Auth::attempt(['username' => $username, 'password' => $password])) {
            throwHttpException(401, 'Invalid username or password');
        }
        return $token;
    }

    public function getAuthenticatedUser(): array 
    {
        $user = Auth::user();

        return $user === null ? [] : json_decode(json_encode($user), true);
    }

    public function decodeToken(string $token): array
    {
        return app('tymon.jwt.provider.jwt')->decode($token);
    }

    public function getRefreshToken(): string
    {
        return JWTAuth::fromUser(Auth::user());
    }

    public function signout(): void
    {
        Auth::logout();
    }
}