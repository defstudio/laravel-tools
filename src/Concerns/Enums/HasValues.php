<?php

namespace DefStudio\Tools\Concerns\Enums;

use BackedEnum;
use Illuminate\Support\Collection;

trait HasValues
{
    /**
     * @return Collection<array-key, string>
     * @noinspection PhpCastIsUnnecessaryInspection
     */
    public static function values(): Collection
    {
        return collect(static::cases())
            ->map(fn (BackedEnum $enum) => (string)$enum->value);
    }
}

