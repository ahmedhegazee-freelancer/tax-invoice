<?php

namespace Modules\Users\Services;

use Modules\Auth\Entities\User;
use Modules\Auth\Services\AgeGroupService;
use Modules\Country\Services\CountryService;
use Modules\Users\DataTransferObjects\CreateUserDto;
use Modules\Users\DataTransferObjects\UpdateUserDto;
use Modules\Users\Entities\Role;
use Spatie\Permission\Models\Permission;

class UserService
{
    public  function getPermissions()
    {
        return Permission::select(['id', 'name'])
            ->get()
            ->map(fn ($permission) => [
                'id' => $permission->id,
                'name' => __('permissions')[$permission->name],
            ]);
    }
    public  function getRoles()
    {
        return Role::where('name', '!=', 'admin')
            ->where('name', '!=', 'super-admin')
            ->where('name', '!=', 'customer');
    }
    public  function getFormattedRoles()
    {
        return $this->getRoles()->get()->map(fn ($role) => ['id' => $role->id, 'name' => $role->name]);
    }
    public function create(CreateUserDto $createUserDto): User
    {
        return  User::create($createUserDto->toArray());
    }
    public function createAdmin(CreateUserDto $createUserDto, array $roles)
    {
        $user = $this->create($createUserDto);
        $user->assignRole(['admin', ...$roles]);
    }
    public function createCustomer(CreateUserDto $createUserDto): User
    {
        $user = $this->create($createUserDto);
        $user->assignRole('customer');
        return $user;
    }
    public function update(User $user, UpdateUserDto $dto)
    {
        $user->update($dto->toArray());
    }
    public function updateAdmin(User $user, UpdateUserDto $dto, array $roles)
    {
        $this->update($user, $dto);
        $user->syncRoles(['admin', ...$roles]);
    }
}