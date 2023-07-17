<?php

namespace Epush\Auth\Infra\Database\Repository;

use Exception;

use Illuminate\Support\Facades\DB;
use Epush\Auth\Infra\Database\Model\User;
use Epush\Auth\Infra\Database\Model\UserRole;

use Epush\Auth\Infra\Database\Repository\Contract\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function __construct(

        private User $user,
        private UserRole $userRole

    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->user->paginate($take)->toArray();

        });
    }

    public function create(array $data): array
    {

        return DB::transaction(function () use ($data) {

            if (! empty($data)) {
                return $this->user->create($data)->toArray();
            }

            return [];

        });

    }

    public function updateByID(string $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            if (! empty($data)) {
                $this->user->where('id', $id)->update($data);
            }

            return $this->user->where('id', $id)->firstOrFail()->toArray();

        });
    }

    public function updateByEmail(string $email, array $data): array
    {
        return DB::transaction(function () use ($email, $data) {

            if (! empty($data)) {
                $this->user->where('email', $email)->update($data);
            }

            return $this->user->where('email', $email)->firstOrFail()->toArray();

        });
    }

    public function getByUsername(string $username): array
    {
        return DB::transaction(function () use ($username) {

            return $this->user->where('username', $username)->firstOrFail()->toArray();

        });
    }

    public function assignRole($userID, $roleName): array
    {
        return DB::transaction(function () use ($userID, $roleName) {

            $role = DB::table('roles')->where('name', $roleName)->first();
            
            if (empty($role)) {
                throw new Exception("Role '{$roleName}' not found");
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

            return $this->userRole->join('roles', 'roles.id', '=', 'users_roles.user_id')
                ->where('user_id', $id)
                ->get()->pluck('name')->toArray();
        });
    }
}