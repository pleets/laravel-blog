<?php

namespace App\Constants\Concerns;

trait HasEnumValues
{
    public static function supported(): array
    {
        return collect(static::toArray())->values()->toArray();
    }
}
