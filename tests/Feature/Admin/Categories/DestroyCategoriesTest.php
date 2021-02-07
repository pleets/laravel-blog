<?php

namespace Tests\Feature\Admin\Categories;

use App\Models\Category;
use App\Constants\Resource;
use App\Facades\UserFactory;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
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
        $category = Category::factory()->create();

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

    /**
     * @test
     */
    public function aUserCanDestroyACategory()
    {
        $user = UserFactory::withPermissions($this->permissions())->create();
        $category = Category::factory()->create();

        $this->actingAs($user)->delete(route('admin.categories.destroy', $category));

        $this->assertDatabaseMissing('categories', $category->toArray());
    }

    /**
     * @test
     */
    public function aUserCanNotDestroyACategoryWhenItHasRelatedPosts()
    {
        $user = UserFactory::withPermissions($this->permissions())->create();
        $category = Category::factory()->create();
        Post::factory()->create(['author_id' => $user->user_id, 'category_id' => $category->category_id]);

        $response = $this->actingAs($user)->delete(route('admin.categories.destroy', $category));

        $response->assertSessionHasErrors('posts_related_error');
    }
}
