<?php

namespace Curia\Auth\Enums\User;

use Curia\Base\Enums\Traits\EnumToArray;

enum UserTypeEnum : int
{
    use EnumToArray;

    case DEFAULT = 1;
    case CURIA_MANAGER = 2;
    case ADMIN = 7;

    public function label(): string
    {
        return match($this) {
            static::DEFAULT => 'Default',
            static::CURIA_MANAGER => 'Curia manager',
            static::ADMIN => 'Administrator',
        };
    }
}