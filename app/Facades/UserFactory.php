<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static withPermissions(string ...$permissions)
 */
class UserFactory extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \App\Helpers\UserFactory::class;
    }
}
