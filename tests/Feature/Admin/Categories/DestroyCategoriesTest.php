<?php

namespace Tests\Feature\Admin\Categories;

use App\Category;
use App\Constants\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\Feature\Concerns\HasAuthentication;
use Tests\Feature\Concerns\HasAuthorization;
use Tests\TestCase;

class DestroyCategoriesTest extends TestCase
{
    use RefreshDatabase;
    use HasAuthentication;
    use HasAuthorization;

    private const HTTP_METHOD = 'DELETE';

    private function route(): string
    {
        $category = factory(Category::class)->create();

        return route('admin.categories.destroy', $category);
    }

    private function permissions()
    {
        return Resource::CATEGORY_DELETE;
    }

    private function onAuthorization(TestResponse $response)
    {
        $response->assertStatus(302);
    }
}
