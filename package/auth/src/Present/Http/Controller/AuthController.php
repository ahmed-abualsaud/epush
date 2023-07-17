<?php

namespace Epush\Auth\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Symfony\Component\HttpFoundation\Response;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\SigninDto;
use Epush\Auth\Domain\DTO\SignupDto;
use Epush\Auth\Domain\DTO\ListRolesDto;
use Epush\Auth\Domain\DTO\ListUsersDto;
use Epush\Auth\Domain\DTO\ResetPasswordDto;
use Epush\Auth\Domain\DTO\ListPermissionsDto;
use Epush\Auth\Domain\DTO\GeneratePasswordDto;

use Epush\Auth\Domain\UseCase\SigninUseCase;
use Epush\Auth\Domain\UseCase\SignupUseCase;
use Epush\Auth\Domain\UseCase\SignoutUseCase;
use Epush\Auth\Domain\UseCase\ListRolesUseCase;
use Epush\Auth\Domain\UseCase\ListUsersUseCase;
use Epush\Auth\Domain\UseCase\ResetPasswordUseCase;
use Epush\Auth\Domain\UseCase\ListPermissionsUseCase;
use Epush\Auth\Domain\UseCase\GeneratePasswordUseCase;
use Epush\Auth\Domain\UseCase\GetAllUserPermissionsUseCase;

#[Prefix('api/auth')]
class AuthController
{
    #[Post('signin')]
    public function signin(SigninDto $signinDto, SigninUseCase $signinUseCase): Response
    {
        return successJSONResponse($signinUseCase->execute($signinDto));
    }

    #[Post('signup')]
    public function signup(SignupDto $signupDto, SignupUseCase $signupUseCase): Response
    {
        return successJSONResponse($signupUseCase->execute($signupDto));
    }

    #[Post('signout')]
    public function signout(SignoutUseCase $signoutUseCase): Response
    {
        return successJSONResponse($signoutUseCase->execute());
    }

    #[Post('reset-password')]
    public function resetPassword(ResetPasswordDto $resetPasswordDto, ResetPasswordUseCase $resetPasswordUseCase): Response
    {
        return successJSONResponse($resetPasswordUseCase->execute($resetPasswordDto));
    }

    #[Post('generate-password')]
    public function generatePassword(GeneratePasswordDto $generatePasswordDto, GeneratePasswordUseCase $generatePasswordUseCase): Response
    {
        return successJSONResponse($generatePasswordUseCase->execute($generatePasswordDto));
    }

    #[Get('user/{user_id}/permissions')]
    public function getAllUserPermissions(UserDto $userDto, GetAllUserPermissionsUseCase $getAllUserPermissionsUseCase): Response
    {
        return successJSONResponse($getAllUserPermissionsUseCase->execute($userDto));
    }

    #[Get('user')]
    public function listUsers(ListUsersDto $listUsersDto, ListUsersUseCase $listUsersUseCase): Response
    {
        return successJSONResponse($listUsersUseCase->execute($listUsersDto));
    }

    #[Get('role')]
    public function listRoles(ListRolesDto $listRolesDto, ListRolesUseCase $listRolesUseCase): Response
    {
        return successJSONResponse($listRolesUseCase->execute($listRolesDto));
    }

    #[Get('permission')]
    public function listPermissions(ListPermissionsDto $listPermissionsDto, ListPermissionsUseCase $listPermissionsUseCase): Response
    {
        return successJSONResponse($listPermissionsUseCase->execute($listPermissionsDto));
    }
}