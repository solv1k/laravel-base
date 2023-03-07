<?php

namespace Curia\Base\Enums\Values;

use UnitEnum;

class ValueWithLabel
{
    public static function toArray(UnitEnum $enum): array
    {
        return [
            'value' => $enum->value,
            'label' => $enum->label()
        ];
    }
}