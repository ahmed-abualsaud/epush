<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ChangePasswordDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'old_password' => 'required|string',
            'new_password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserID(): string
    {
        return $this->data['user_id']?? '';
    }

    public function getOldPassword(): string
    {
        return $this->data['old_password']?? '';
    }

    public function getNewPassword(): string
    {
        return $this->data['new_password']?? '';
    }
}