<?php

namespace Tests\Feature\Concerns;

use App\Facades\UserFactory;
use App\Models\User;

trait HasAuthorization
{
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
     */
    public function anAuthorizedUserCanAccessToTheRoute()
    {
        $user = UserFactory::withPermissions($this->permissions())->create();

        $response = $this->actingAs($user)->call(self::HTTP_METHOD, $this->route());

        $this->onAuthorization($response);
    }
}
