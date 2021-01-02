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

class IndexCategoriesTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthentication;
    use HasAuthorization;

    private const HTTP_METHOD = 'GET';

    private function route(): string
    {
        return route('admin.categories.index');
    }

    private function permissions()
    {
        return Resource::CATEGORY_INDEX;
    }

    private function onAuthorization(TestResponse $response)
    {
        $response->assertOk();
    }

    /**
     * @test
     */
    public function theIndexViewContainsCategories()
    {
        $user = UserFactory::withPermissions($this->permissions())->create();

        $categories = factory(Category::class, 3)->create();

        $response = $this->actingAs($user)->get($this->route());
        $data = $response->original->getData()['categories'];

        $this->assertTrue($data->contains($categories->first()));
    }
}
