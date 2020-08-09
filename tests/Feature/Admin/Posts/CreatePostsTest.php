<?php

namespace Tests\Feature\Admin\Posts;

use App\Constants\Resource;
use App\Facades\UserFactory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostsTest extends TestCase
{
    use RefreshDatabase;

    private function route(): string
    {
        return route('admin.posts.create');
    }

    /**
     * @test
     */
    public function anUnauthenticatedUserCanNotAccessToCreateView()
    {
        $response = $this->get($this->route());

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function anUnauthorizedUserCanNotAccessToCreateView()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get($this->route());

        $response->assertForbidden();
    }

    /**
     * @test
     */
    public function anAuthorizedUserCanAccessToCreateView()
    {
        $user = UserFactory::withPermissions(Resource::POST_CREATE)->create();

        $response = $this->actingAs($user)->get($this->route());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function aUserCanViewTheNecessaryFieldsInTheCreateView()
    {
        $user = UserFactory::withPermissions(Resource::POST_CREATE)->create();

        $response = $this->actingAs($user)->get($this->route());

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
