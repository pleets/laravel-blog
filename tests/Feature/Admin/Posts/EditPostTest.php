<?php

namespace Tests\Feature\Admin\Posts;

use App\Constants\Resource;
use App\Facades\UserFactory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditPostTest extends TestCase
{
    use RefreshDatabase;

    private function route($post): string
    {
        return route('admin.posts.edit', $post);
    }

    /**
     * @test
     */
    public function anUnauthenticatedUserCanNotAccessToEditView()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->user_id]);

        $response = $this->get($this->route($post));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anUnauthorizedUserCanNotAccessToEditView()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->user_id]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get($this->route($post));

        $response->assertForbidden();
    }

    /**
     * @test
     */
    public function anAuthorizedUserCanAccessToEditView()
    {
        $user = UserFactory::withPermissions(Resource::POST_UPDATE)->create();
        $post = Post::factory()->create(['author_id' => $user->user_id]);

        $response = $this->actingAs($user)->get($this->route($post));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function aUserCanViewTheNecessaryFieldsInTheEditView()
    {
        $user = UserFactory::withPermissions(Resource::POST_UPDATE)->create();
        $post = Post::factory()->create(['author_id' => $user->user_id]);

        $response = $this->actingAs($user)->get($this->route($post));

        $response
            ->assertSee(__('posts.fields.title'))
            ->assertSee(__('posts.fields.category'))
            ->assertSee(__('posts.fields.tags'))
            ->assertSee(__('posts.fields.content'))
            ->assertSee(__('posts.fields.published_at'))
            ->assertSee(__('posts.fields.url'))
            ->assertSee(__('posts.fields.description'))
            ->assertSee(__('posts.fields.image'))
        ;
    }
}
