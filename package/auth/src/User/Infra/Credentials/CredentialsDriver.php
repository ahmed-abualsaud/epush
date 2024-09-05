<?php

namespace Epush\Auth\User\Infra\Credentials;

use Exception;

use Ichtrojan\Otp\Otp;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Epush\Auth\User\App\Contract\BlockedIPDatabaseServiceContract;
use Epush\Auth\User\App\Contract\UserDatabaseServiceContract;

class CredentialsDriver implements CredentialsDriverContract
{
    public function __construct(

        private UserDatabaseServiceContract $userServiceContract,

        private BlockedIPDatabaseServiceContract $blockedIPDatabaseService

    ) {}

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

    public function attemptOrFail(string $username, string $password, bool $rememberMe = false): string
    {
        $blockedIP = $this->blockedIPDatabaseService->getBlockedIP(request()->ip());

        if (! empty($blockedIP) && $blockedIP['tries'] >= 5) {
            throwHttpException(401, 'Maximum number of login tries reached');
        }

        if ($rememberMe) {
            $token = Auth::attempt(['username' => $username, 'password' => $password], true);
        } else {
            $token = Auth::attempt(['username' => $username, 'password' => $password]);
        }

        if (! $token) {
            $this->blockedIPDatabaseService->addBlockedIP(['ip' => request()->ip()]);
            throwHttpException(401, 'Invalid username or password');
        }

        $this->blockedIPDatabaseService->addBlockedIP(['ip' => request()->ip(), 'tries' => 0]);
        return $token;
    }

    public function getAuthenticatedUser(bool $signin = false): array 
    {
        $user = Auth::user();
        try {
            if (! $signin) {
                $token = request()->header('Authorization');
                $payload = $this->decodeToken(substr($token, 7));
                $user = $this->userServiceContract->getUser($payload['sub'], true);
            }
        } catch(Exception $e) {
            $user = Auth::user();
        }

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