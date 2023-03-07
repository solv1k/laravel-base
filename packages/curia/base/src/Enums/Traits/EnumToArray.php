<?php

namespace Curia\Base\Enums\Traits;

/**
 * Добавляет возможность получать варианты перечисления в разных форматах массивов.
 */
trait EnumToArray
{
    /**
     * Возвращает имя перечисления по его значению.
     * 
     * @param int|string $value
     * @return string
     */
    public static function name(int|string $value): string
    {
        return self::array()[$value];
    }

    /**
     * Возвращает массив имён перечисления.
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Возвращает массив значений перечисления.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Возвращает строку конкатенации из значений перечисления.
     *
     * @return string
     */
    public static function implodedValues(string $separator = ','): string
    {
        return implode($separator, self::values());
    }

    /**
     * Возвращает все лейблы перечисления.
     *
     * @return array
     */
    public static function labels(): array
    {
        return collect(self::cases())->map(fn($case) => $case->label())->toArray();
    }

    /**
     * Возвращает ассоциативный массив в виде "значение => имя".
     *
     * @return array
     */
    public static function array(bool $useLabels = false): array
    {
        return array_combine(self::values(), $useLabels ? self::labels() : self::names());
    }
}
