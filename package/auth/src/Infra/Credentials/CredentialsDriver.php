<?php

namespace Epush\Auth\Infra\Credentials;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class CredentialsDriver implements CredentialsDriverContract
{
    public function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    public function generatePassword(): string
    {
        return Str::password(12, true, true, true, false);
    }

    public function attemptOrFail(string $username, string $password): string
    {
        if (! $token = Auth::attempt(['username' => $username, 'password' => $password])) {
            throw new AuthenticationException('Invalid username or password');
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

    public function signout(): void
    {
        Auth::logout();
    }
}