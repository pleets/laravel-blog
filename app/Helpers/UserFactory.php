<?php

namespace App\Helpers;

use App\User;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class UserFactory
{
    /**
     * @var Collection|null
     */
    private $permissions;

    /**
     * @param string ...$permissions
     * @return $this
     */
    public function withPermissions(string ...$permissions): self
    {
        $this->permissions = collect($permissions)->flatten();

        return $this;
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes = []): User
    {
        $user = factory(User::class)->create($attributes);

        if ($this->hasPermissions()) {
            $this->createPermissions();
            $user->syncPermissions($this->permissions->all());
        }

        return $user;
    }

    public function hasPermissions(): bool
    {
        return !is_null($this->permissions);
    }

    private function createPermissions(): void
    {
        $this->permissions->each(function ($permission) {
            Permission::firstOrCreate(['name' => $permission]);
        });
    }
}
