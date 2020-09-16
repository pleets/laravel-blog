<?php

namespace Tests\Feature\Admin\Categories\Concerns;

use Faker\Factory;

trait CategoryFieldsProvider
{
    /**
     * Returns several right fields values.
     */
    public function fieldsProvider(): array
    {
        $faker = Factory::create();

        return [
            'name field' => ['name', $faker->text(80)],
            'slug field' => ['slug', $faker->slug(2)],
        ];
    }

    /**
     * Returns several wrong fields values.
     */
    public function wrongFieldsProvider(): array
    {
        $faker = Factory::create();

        return [
            'Empty name' => ['name', ''],
            'Name too long' => ['name', $faker->paragraph(10)],
            'Empty slug' => ['slug', ''],
            'Slug too long' => ['slug', $faker->paragraph(10)],
        ];
    }
}
