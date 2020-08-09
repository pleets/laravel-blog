<?php

namespace App\Constants;

use App\Constants\Concerns\HasEnumValues;
use MyCLabs\Enum\Enum;

class Resource extends Enum
{
    use HasEnumValues;

    public const POST_INDEX = 'post.index';
    public const POST_CREATE = 'post.create';
    public const POST_UPDATE = 'post.update';
}
