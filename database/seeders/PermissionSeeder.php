<?php

namespace Database\Seeders;

use App\Constants\Resource;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Resource::supported() as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
