<?php

namespace Epush\Auth\User\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Auth\User\Infra\Database\Model\User;
use Epush\Auth\User\Infra\Database\Model\UserRole;
use Epush\Auth\User\Infra\Database\Model\UserPermission;

use Epush\Auth\User\Infra\Database\Repository\Contract\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function __construct(

        private User $user,
        private UserRole $userRole,
        private UserPermission $userPermission

    ) {}

    public function get(string $userID, bool $withHiddens = false): array
    {
        return DB::transaction(function () use ($userID, $withHiddens) {

            $user = $this->user->where('id', $userID)->firstOrFail();
            $withHiddens && $user->makeVisible('password') && $user->makeVisible('remember_token');
            $userData = $user->toArray();
            $withHiddens && $user->makeHidden('password') && $user->makeVisible('remember_token');
            return $userData;

        });
    }

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->user->paginate($take)->toArray();

        });
    }

    public function create(array $data): array
    {

        return DB::transaction(function () use ($data) {

            return $this->user->blindCreate($data);
        });
    }

    public function delete(string $id): bool
    {
        return DB::transaction(function () use ($id) {

            $this->userRole->where('user_id', $id)->delete();
            $this->userPermission->where('user_id', $id)->delete();
            return $this->user->where('id', $id)->delete();

        }); 
    }

    public function getUsers(array $usersID): array
    {
        return DB::transaction(function () use ($usersID) {

            return $this->user->whereIn('id', $usersID)->get()->toArray();

        }); 
    }

    public function updateByID(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $user = $this->user->where('id', $id)->firstOrFail();

            if (! empty($data)) {
                $user->update($data);
            }

            return $user->toArray();

        });
    }

    public function updateByEmail(string $email, array $data): array
    {
        return DB::transaction(function () use ($email, $data) {

            $user = $this->user->where('email', $email)->firstOrFail();

            if (! empty($data)) {
                $user->update($data);
            }

            return $user->toArray();

        });
    }

    public function getByUsername(string $username): array
    {
        return DB::transaction(function () use ($username) {

            $user = $this->user->where('username', $username)->first();
            return empty($user) ? [] : $user->makeVisible('password')->toArray();


        });
    }

    public function assignRole($userID, $roleName): array
    {
        return DB::transaction(function () use ($userID, $roleName) {

            $role = DB::table('roles')->where('name', $roleName)->first();
            
            if (empty($role)) {
                throwHttpException(400, "Role '{$roleName}' not found");
            }

            return $this->userRole->create([
                'user_id' => $userID,
                'role_id' => $role->id
            ])->toArray();
        });
    }

    public function getUserRoles(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->user->select('roles.name', 'roles.id')
                ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
                ->join('roles', 'users_roles.role_id', '=', 'roles.id')
                ->where('users_roles.user_id', $id)
                ->get()
                ->toArray();
        });
    }

    public function getUserPermissions(string $id): array
    {
        return DB::transaction(function () use ($id) {

            return $this->user->join('users_permissions', 'users_permissions.user_id', '=', 'users.id')
                ->where('users_permissions.user_id', $id)
                ->get()->toArray();

        });
    }

    public function assignRoles(string $userID, array $rolesID): bool
    {
        return DB::transaction(function () use ($userID, $rolesID) {

            foreach ($rolesID as $roleID) {
                $input = [
                    'user_id' => $userID, 
                    'role_id' => $roleID,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ];

                $this->userRole->updateOrCreate([
                    'user_id' => $userID, 
                    'role_id' => $roleID
                ], $input);
            }

            return true;

        });
    }

    public function assignPermissions(string $userID, array $permissionsID): bool
    {
        return DB::transaction(function () use ($userID, $permissionsID) {

            foreach ($permissionsID as $permissionID) {
                $input = [
                    'user_id' => $userID, 
                    'permission_id' => $permissionID,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ];

                $this->userPermission->updateOrCreate([
                    'user_id' => $userID, 
                    'permission_id' => $permissionID
                ], $input);
            }

            return true;

        });
    }

    public function unassignRoles(string $userID, array $rolesID): bool
    {
        return DB::transaction(function () use ($userID, $rolesID) {

            return $this->userRole->where('user_id', $userID)->whereIn('role_id', $rolesID)->delete();

        });
    }

    public function unassignPermissions(string $userID, array $permissionsID): bool
    {
        return DB::transaction(function () use ($userID, $permissionsID) {

            return $this->userPermission->where('user_id', $userID)->whereIn('permission_id', $permissionsID)->delete();

        });
    }

    public function checkUserEnabledOrFail(string $userName): bool
    {
        return DB::transaction(function () use ($userName) {

            $user = $this->user->where('username', $userName)->where('enabled', true)->get()->toArray();
            if (empty($user)) {
                throwHttpException(400, "{$userName}'s account has been disabled");
            }
            return true;

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10, array $usersID = null): array
    {
        return DB::transaction(function () use ($column, $value, $take, $usersID) {

            $users = $usersID ? $this->user->whereIn('id', $usersID) : $this->user;

            if ($column === "enabled") {
                $users = $users->where($column, $value);
            } else {
                $users = $users->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'");
            }
            
            $users = $take >= 1000000000000 ? $users->paginate($take, ['*'], 'page', 1) : $users->paginate($take);
            return $users->toArray();

        });
    }
}