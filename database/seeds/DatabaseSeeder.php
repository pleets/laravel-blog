<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionSeeder::class,
            AdminUserSeeder::class,
            TagsTableSeeder::class,
            CategoriesTableSeeder::class,
            WriterSeeder::class,
        ]);
    }
}
