<?php

namespace Epush\Auth\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Symfony\Component\HttpFoundation\Response;

use Epush\Auth\Domain\DTO\UserDto;
use Epush\Auth\Domain\DTO\RoleDto;
use Epush\Auth\Domain\DTO\SigninDto;
use Epush\Auth\Domain\DTO\SignupDto;
use Epush\Auth\Domain\DTO\AddRoleDto;
use Epush\Auth\Domain\DTO\ListRolesDto;
use Epush\Auth\Domain\DTO\ListUsersDto;
use Epush\Auth\Domain\DTO\PermissionDto;
use Epush\Auth\Domain\DTO\UpdateUserDto;
use Epush\Auth\Domain\DTO\UpdateRoleDto;
use Epush\Auth\Domain\DTO\ResetPasswordDto;
use Epush\Auth\Domain\DTO\ListPermissionsDto;
use Epush\Auth\Domain\DTO\AssignUserRolesDto;
use Epush\Auth\Domain\DTO\GeneratePasswordDto;
use Epush\Auth\Domain\DTO\UpdatePermissionDto;
use Epush\Auth\Domain\DTO\UnassignUserRolesDto;
use Epush\Auth\Domain\DTO\AssignUserPermissionsDto;
use Epush\Auth\Domain\DTO\AssignRolePermissionsDto;
use Epush\Auth\Domain\DTO\UnassignRolePermissionsDto;
use Epush\Auth\Domain\DTO\UnassignUserPermissionsDto;

use Epush\Auth\Domain\UseCase\SigninUseCase;
use Epush\Auth\Domain\UseCase\SignupUseCase;
use Epush\Auth\Domain\UseCase\SignoutUseCase;
use Epush\Auth\Domain\UseCase\AddRoleUseCase;
use Epush\Auth\Domain\UseCase\ListRolesUseCase;
use Epush\Auth\Domain\UseCase\ListUsersUseCase;
use Epush\Auth\Domain\UseCase\UpdateUserUseCase;
use Epush\Auth\Domain\UseCase\UpdateRoleUseCase;
use Epush\Auth\Domain\UseCase\DeleteUserUseCase;
use Epush\Auth\Domain\UseCase\DeleteRoleUseCase;
use Epush\Auth\Domain\UseCase\GetUserRolesUseCase;
use Epush\Auth\Domain\UseCase\ResetPasswordUseCase;
use Epush\Auth\Domain\UseCase\ListPermissionsUseCase;
use Epush\Auth\Domain\UseCase\AssignUserRolesUseCase;
use Epush\Auth\Domain\UseCase\DeletePermissionUseCase;
use Epush\Auth\Domain\UseCase\GeneratePasswordUseCase;
use Epush\Auth\Domain\UseCase\UpdatePermissionUseCase;
use Epush\Auth\Domain\UseCase\UnassignUserRolesUseCase;
use Epush\Auth\Domain\UseCase\GetUserPermissionsUseCase;
use Epush\Auth\Domain\UseCase\GetRolePermissionsUseCase;
use Epush\Auth\Domain\UseCase\GetAllUserPermissionsUseCase;
use Epush\Auth\Domain\UseCase\AssignUserPermissionsUseCase;
use Epush\Auth\Domain\UseCase\AssignRolePermissionsUseCase;
use Epush\Auth\Domain\UseCase\UnassignUserPermissionsUseCase;
use Epush\Auth\Domain\UseCase\UnassignRolePermissionsUseCase;

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

    #[Delete('user/{user_id}')]
    public function deleteuser(UserDto $userDto, DeleteUserUseCase $deleteUserUseCase): Response
    {
        return successJSONResponse($deleteUserUseCase->execute($userDto));
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

    #[Put('user/{user_id}')]
    public function updateUser(UserDto $userDto, UpdateUserDto $updateUserDto, UpdateUserUseCase $updateUserUseCase): Response
    {
        return successJSONResponse($updateUserUseCase->execute($userDto, $updateUserDto));
    }

    #[Get('user')]
    public function listUsers(ListUsersDto $listUsersDto, ListUsersUseCase $listUsersUseCase): Response
    {
        return successJSONResponse($listUsersUseCase->execute($listUsersDto));
    }

    #[Get('user/{user_id}/roles')]
    public function getUserRules(UserDto $userDto, GetUserRolesUseCase $getUserRolesUseCase): Response
    {
        return successJSONResponse($getUserRolesUseCase->execute($userDto));
    }

    #[Get('user/{user_id}/permissions')]
    public function getUserPermissions(UserDto $userDto, GetUserPermissionsUseCase $getUserPermissionsUseCase): Response
    {
        return successJSONResponse($getUserPermissionsUseCase->execute($userDto));
    }

    #[Get('user/{user_id}/all-permissions')]
    public function getAllUserPermissions(UserDto $userDto, GetAllUserPermissionsUseCase $getAllUserPermissionsUseCase): Response
    {
        return successJSONResponse($getAllUserPermissionsUseCase->execute($userDto));
    }

    #[Get('role')]
    public function listRoles(ListRolesDto $listRolesDto, ListRolesUseCase $listRolesUseCase): Response
    {
        return successJSONResponse($listRolesUseCase->execute($listRolesDto));
    }

    #[Get('role/{role_id}/permissions')]
    public function getRolePermissions(RoleDto $roleDto, GetRolePermissionsUseCase $getRolePermissionsUseCase): Response
    {
        return successJSONResponse($getRolePermissionsUseCase->execute($roleDto));
    }

    #[Post('role/{role_id}/permissions')]
    public function assignRolePermissions(RoleDto $roleDto, AssignRolePermissionsDto $assignRolePermissionsDto, AssignRolePermissionsUseCase $assignRolePermissionsUseCase): Response
    {
        return successJSONResponse($assignRolePermissionsUseCase->execute($roleDto, $assignRolePermissionsDto));
    }

    #[Put('role/{role_id}/permissions')]
    public function unassignRolePermissions(RoleDto $roleDto, UnassignRolePermissionsDto $unassignRolePermissionsDto, UnassignRolePermissionsUseCase $unassignRolePermissionsUseCase): Response
    {
        return successJSONResponse($unassignRolePermissionsUseCase->execute($roleDto, $unassignRolePermissionsDto));
    }

    #[Get('permission')]
    public function listPermissions(ListPermissionsDto $listPermissionsDto, ListPermissionsUseCase $listPermissionsUseCase): Response
    {
        return successJSONResponse($listPermissionsUseCase->execute($listPermissionsDto));
    }

    #[Post('user/{user_id}/roles')]
    public function assignUserRoles(UserDto $userDto, AssignUserRolesDto $assignUserRolesDto, AssignUserRolesUseCase $assignUserRolesUseCase): Response
    {
        return successJSONResponse($assignUserRolesUseCase->execute($userDto, $assignUserRolesDto));
    }

    #[Put('user/{user_id}/roles')]
    public function unassignUserRoles(UserDto $userDto, UnassignUserRolesDto $unassignUserRolesDto, UnassignUserRolesUseCase $unassignUserRolesUseCase): Response
    {
        return successJSONResponse($unassignUserRolesUseCase->execute($userDto, $unassignUserRolesDto));
    }

    #[Post('user/{user_id}/permissions')]
    public function assignUserPermissions(UserDto $userDto, AssignUserPermissionsDto $assignUserPermissionsDto, AssignUserPermissionsUseCase $assignUserPermissionsUseCase): Response
    {
        return successJSONResponse($assignUserPermissionsUseCase->execute($userDto, $assignUserPermissionsDto));
    }

    #[Put('user/{user_id}/permissions')]
    public function unassignUserPermissions(UserDto $userDto, UnassignUserPermissionsDto $unassignUserPermissionsDto, UnassignUserPermissionsUseCase $unassignUserPermissionsUseCase): Response
    {
        return successJSONResponse($unassignUserPermissionsUseCase->execute($userDto, $unassignUserPermissionsDto));
    }

    #[Post('role')]
    public function addRole(AddRoleDto $addRoleDto, AddRoleUseCase $addRoleUseCase): Response
    {
        return successJSONResponse($addRoleUseCase->execute($addRoleDto));
    }

    #[Put('role/{role_id}')]
    public function updateRole(RoleDto $roleDto, UpdateRoleDto $updateRoleDto, UpdateRoleUseCase $updateRoleUseCase): Response
    {
        return successJSONResponse($updateRoleUseCase->execute($roleDto, $updateRoleDto));
    }

    #[Delete('role/{role_id}')]
    public function deleteRole(RoleDto $roleDto, DeleteRoleUseCase $deleteRoleUseCase): Response
    {
        return successJSONResponse($deleteRoleUseCase->execute($roleDto));
    }

    #[Put('permission/{permission_id}')]
    public function updtePermission(PermissionDto $permissionDto, UpdatePermissionDto $updatePermissionDto, UpdatePermissionUseCase $updatePermissionUseCase): Response
    {
        return successJSONResponse($updatePermissionUseCase->execute($permissionDto, $updatePermissionDto));
    }

    #[Delete('permission/{permission_id}')]
    public function deletePermission(PermissionDto $permissionDto, DeletePermissionUseCase $deletePermissionUseCase): Response
    {
        return successJSONResponse($deletePermissionUseCase->execute($permissionDto));
    }
}