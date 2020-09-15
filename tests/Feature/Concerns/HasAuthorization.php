<?php

namespace Tests\Feature\Concerns;

use App\Facades\UserFactory;
use App\User;

trait HasAuthorization
{
    /**
     * @test
     */
    public function anUnauthorizedUserCanNotAccessToTheRoute()
    {
        $user = factory(User::class)->create();

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
