<?php

namespace Epush\Auth\User\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Symfony\Component\HttpFoundation\Response;

use Epush\Auth\User\Domain\DTO\UserDto;
use Epush\Auth\User\Domain\DTO\SigninDto;
use Epush\Auth\User\Domain\DTO\SignupDto;
use Epush\Auth\User\Domain\DTO\ListUsersDto;
use Epush\Auth\User\Domain\DTO\UpdateUserDto;
use Epush\Auth\User\Domain\DTO\SearchUserDto;
use Epush\Auth\User\Domain\DTO\ResetPasswordDto;
use Epush\Auth\User\Domain\DTO\AssignUserRolesDto;
use Epush\Auth\User\Domain\DTO\GeneratePasswordDto;
use Epush\Auth\User\Domain\DTO\UnassignUserRolesDto;
use Epush\Auth\User\Domain\DTO\AssignUserPermissionsDto;
use Epush\Auth\User\Domain\DTO\UnassignUserPermissionsDto;

use Epush\Auth\User\Domain\UseCase\SigninUseCase;
use Epush\Auth\User\Domain\UseCase\SignupUseCase;
use Epush\Auth\User\Domain\UseCase\SignoutUseCase;
use Epush\Auth\User\Domain\UseCase\GetUserUseCase;
use Epush\Auth\User\Domain\UseCase\ListUsersUseCase;
use Epush\Auth\User\Domain\UseCase\UpdateUserUseCase;
use Epush\Auth\User\Domain\UseCase\DeleteUserUseCase;
use Epush\Auth\User\Domain\UseCase\SearchUserUseCase;
use Epush\Auth\User\Domain\UseCase\GetUserRolesUseCase;
use Epush\Auth\User\Domain\UseCase\ResetPasswordUseCase;
use Epush\Auth\User\Domain\UseCase\AssignUserRolesUseCase;
use Epush\Auth\User\Domain\UseCase\GeneratePasswordUseCase;
use Epush\Auth\User\Domain\UseCase\UnassignUserRolesUseCase;
use Epush\Auth\User\Domain\UseCase\GetUserPermissionsUseCase;
use Epush\Auth\User\Domain\UseCase\GetAllUserPermissionsUseCase;
use Epush\Auth\User\Domain\UseCase\AssignUserPermissionsUseCase;
use Epush\Auth\User\Domain\UseCase\UnassignUserPermissionsUseCase;


#[Prefix('api/auth/user')]
class UserController
{
    #[Post('signin')]
    public function signin(SigninDto $signinDto, SigninUseCase $signinUseCase): Response
    {
        return jsonResponse($signinUseCase->execute($signinDto));
    }

    #[Post('signup')]
    public function signup(SignupDto $signupDto, SignupUseCase $signupUseCase): Response
    {
        return jsonResponse($signupUseCase->execute($signupDto));
    }

    #[Post('signout')]
    public function signout(SignoutUseCase $signoutUseCase): Response
    {
        return jsonResponse($signoutUseCase->execute());
    }

    #[Post('reset-password')]
    public function resetPassword(ResetPasswordDto $resetPasswordDto, ResetPasswordUseCase $resetPasswordUseCase): Response
    {
        return jsonResponse($resetPasswordUseCase->execute($resetPasswordDto));
    }

    #[Post('generate-password')]
    public function generatePassword(GeneratePasswordDto $generatePasswordDto, GeneratePasswordUseCase $generatePasswordUseCase): Response
    {
        return jsonResponse($generatePasswordUseCase->execute($generatePasswordDto));
    }

    #[Get('/')]
    public function listUsers(ListUsersDto $listUsersDto, ListUsersUseCase $listUsersUseCase): Response
    {
        return jsonResponse($listUsersUseCase->execute($listUsersDto));
    }

    #[Get('{user_id}')]
    public function getUser(UserDto $userDto, GetUserUseCase $getUserUseCase): Response
    {
        return jsonResponse($getUserUseCase->execute($userDto));
    }

    #[Put('{user_id}')]
    public function updateUser(UserDto $userDto, UpdateUserDto $updateUserDto, UpdateUserUseCase $updateUserUseCase): Response
    {
        return jsonResponse($updateUserUseCase->execute($userDto, $updateUserDto));
    }

    #[Delete('{user_id}')]
    public function deleteuser(UserDto $userDto, DeleteUserUseCase $deleteUserUseCase): Response
    {
        return jsonResponse($deleteUserUseCase->execute($userDto));
    }

    #[Get('{user_id}/roles')]
    public function getUserRoles(UserDto $userDto, GetUserRolesUseCase $getUserRolesUseCase): Response
    {
        return jsonResponse($getUserRolesUseCase->execute($userDto));
    }

    #[Get('{user_id}/permissions')]
    public function getUserPermissions(UserDto $userDto, GetUserPermissionsUseCase $getUserPermissionsUseCase): Response
    {
        return jsonResponse($getUserPermissionsUseCase->execute($userDto));
    }

    #[Get('{user_id}/all-permissions')]
    public function getAllUserPermissions(UserDto $userDto, GetAllUserPermissionsUseCase $getAllUserPermissionsUseCase): Response
    {
        return jsonResponse($getAllUserPermissionsUseCase->execute($userDto));
    }

    #[Post('{user_id}/roles')]
    public function assignUserRoles(UserDto $userDto, AssignUserRolesDto $assignUserRolesDto, AssignUserRolesUseCase $assignUserRolesUseCase): Response
    {
        return jsonResponse($assignUserRolesUseCase->execute($userDto, $assignUserRolesDto));
    }

    #[Put('{user_id}/roles')]
    public function unassignUserRoles(UserDto $userDto, UnassignUserRolesDto $unassignUserRolesDto, UnassignUserRolesUseCase $unassignUserRolesUseCase): Response
    {
        return jsonResponse($unassignUserRolesUseCase->execute($userDto, $unassignUserRolesDto));
    }

    #[Post('{user_id}/permissions')]
    public function assignUserPermissions(UserDto $userDto, AssignUserPermissionsDto $assignUserPermissionsDto, AssignUserPermissionsUseCase $assignUserPermissionsUseCase): Response
    {
        return jsonResponse($assignUserPermissionsUseCase->execute($userDto, $assignUserPermissionsDto));
    }

    #[Put('{user_id}/permissions')]
    public function unassignUserPermissions(UserDto $userDto, UnassignUserPermissionsDto $unassignUserPermissionsDto, UnassignUserPermissionsUseCase $unassignUserPermissionsUseCase): Response
    {
        return jsonResponse($unassignUserPermissionsUseCase->execute($userDto, $unassignUserPermissionsDto));
    }

    #[Post('search')]
    public function searchUserColumn(SearchUserDto $searchUserDto, SearchUserUseCase $searchUserUseCase): Response
    {
        return jsonResponse($searchUserUseCase->execute($searchUserDto));
    }
}