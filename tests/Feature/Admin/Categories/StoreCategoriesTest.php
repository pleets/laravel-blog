<?php

namespace Tests\Feature\Admin\Categories;

use App\Category;
use App\Constants\Resource;
use App\Facades\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\Feature\Concerns\HasAuthentication;
use Tests\Feature\Concerns\HasAuthorization;
use Tests\TestCase;

class StoreCategoriesTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthentication;
    use HasAuthorization;

    private const HTTP_METHOD = 'POST';

    private function route(): string
    {
        $category = factory(Category::class)->make()->toArray();

        return route('admin.categories.store', $category);
    }

    private function permissions()
    {
        return Resource::CATEGORY_CREATE;
    }

    private function onAuthorization(TestResponse $response)
    {
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function aUserCanStoreCategories()
    {
        $user = UserFactory::withPermissions($this->permissions())->create();
        $category = factory(Category::class)->make()->toArray();

        $this->actingAs($user)->post(route('admin.categories.store', $category));

        $this->assertDatabaseHas('categories', [
            'name' => $category['name'],
            'slug' => $category['slug'],
        ]);
    }

    /**
     * @test
     */
    public function aUserCanNotStoreACategoryWithAnAlreadyTakenSlug()
    {
        $category = factory(Category::class)->create();

        $user = UserFactory::withPermissions($this->permissions())->create();
        $category = factory(Category::class)->make(['slug' => $category->slug])->toArray();

        $response = $this->actingAs($user)->post(route('admin.categories.store', $category));

        $response->assertSessionHasErrors('slug');
    }
}
