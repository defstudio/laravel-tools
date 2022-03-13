<?php

namespace DefStudio\Tools\Concerns\Enums;

use BackedEnum;
use Illuminate\Support\Collection;

/**
 * @mixin BackedEnum
 */
trait HasLabels
{
    /**
     * @return Collection<string, string>
     */
    public static function labels(): Collection
    {
        /* @phpstan-ignore-next-line */
        return collect(static::cases())
            ->mapWithKeys(fn (BackedEnum|self $enum) => [
                $enum->value => $enum->label(),
            ]);
    }

    abstract public function label();
}
