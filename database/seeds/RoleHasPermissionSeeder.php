<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Constants\Resource;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdminRolePermissions();
        $this->createWriterRolePermissions();
    }

    /**
     * Creates the permissions for the role Admin
     */
    private function createAdminRolePermissions()
    {
        $role = Role::findByName('Admin');
        $role->syncPermissions(Permission::all());
    }

    /**
     * Creates the permissions for the role Moderator
     */
    private function createWriterRolePermissions()
    {
        $role = Role::findByName('Writer');
        $role->syncPermissions(Permission::whereIn('name', [
            Resource::POST_INDEX,
            Resource::POST_CREATE,
        ])->get());
    }
}
