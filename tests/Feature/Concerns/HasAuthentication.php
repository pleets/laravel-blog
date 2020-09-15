<?php

namespace Tests\Feature\Concerns;

trait HasAuthentication
{
    /**
     * @test
     */
    public function anUnauthenticatedUserCanNotAccessToTheRoute()
    {
        $response = $this->call(self::HTTP_METHOD, $this->route());

        $response->assertRedirect(route('login'));
    }
}
