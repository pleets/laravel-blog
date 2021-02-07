<?php

namespace Tests\Feature\Admin\Categories;

use App\Models\Category;
use App\Constants\Resource;
use App\Facades\UserFactory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\Feature\Admin\Categories\Concerns\CategoryFieldsProvider;
use Tests\Feature\Concerns\HasAuthentication;
use Tests\Feature\Concerns\HasAuthorization;
use Tests\TestCase;

class UpdateCategoriesTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthentication;
    use HasAuthorization;
    use CategoryFieldsProvider;

    private const HTTP_METHOD = 'PATCH';

    private function route(): string
    {
        $category = Category::factory()->create();

        return route('admin.categories.update', $category);
    }

    private function permissions()
    {
        return Resource::CATEGORY_UPDATE;
    }

    private function onAuthorization(TestResponse $response)
    {
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function anUnauthorizedUserCanNotAccessToTheRoute()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->call(self::HTTP_METHOD, $this->route());

        $response->assertForbidden();
    }


    /**
     * @test
     * @dataProvider fieldsProvider
     *
     * @param $field
     * @param $value
     */
    public function aUserCanUpdateCategories($field, $value)
    {
        $user = UserFactory::withPermissions($this->permissions())->create();
        $category = Category::factory()->create();

        $formData = array_replace(
            $category->only([
                'name',
                'slug',
            ]),
            [$field => $value]
        );

        $this->actingAs($user)
            ->put(route('admin.categories.update', $category), $formData)
        ;

        $this->assertDatabaseHas('categories', $formData);
    }

    /**
     * @test
     * @dataProvider wrongFieldsProvider
     *
     * @param $field
     * @param $value
     */
    public function theCategoryUpdatingValidatesAllRelatedFields($field, $value)
    {
        $user = UserFactory::withPermissions($this->permissions())->create();
        $category = Category::factory()->create();

        $formData = array_replace(
            $category->only([
                'name',
                'slug',
            ]),
            [$field => $value]
        );

        $response = $this->actingAs($user)
            ->put(route('admin.categories.update', $category), $formData)
        ;

        $response->assertSessionHasErrors($field);
    }
}
