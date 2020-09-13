<?php

namespace Tests\Feature\Admin\Categories;

use App\Constants\Resource;
use App\Facades\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\Feature\Concerns\HasAuthentication;
use Tests\Feature\Concerns\HasAuthorization;
use Tests\TestCase;

class CreateCategoriesTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthentication;
    use HasAuthorization;

    private const HTTP_METHOD = 'GET';

    private function route(): string
    {
        return route('admin.categories.create');
    }

    private function permissions()
    {
        return Resource::CATEGORY_CREATE;
    }

    private function onAuthorization(TestResponse $response)
    {
        $response->assertOk();
    }

    /**
     * @test
     */
    public function theCreateViewContainsTheNecessaryFields()
    {
        $user = UserFactory::withPermissions($this->permissions())->create();

        $response = $this->actingAs($user)->get($this->route());

        $response
            ->assertSee(__('categories.fields.name'))
            ->assertSee(__('categories.fields.slug'))
        ;
    }
}
