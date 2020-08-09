<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class CollectionParser
{
    public static function toKeyPair(Collection $collection, string $key, string $value): array
    {
        $dropdown = [];
        foreach ($collection as $model) {
            $dropdown[$model->{$key}] = $model->{$value};
        }

        return $dropdown;
    }
}
