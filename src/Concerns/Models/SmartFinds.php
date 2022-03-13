<?php

namespace DefStudio\Tools\Concerns\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait SmartFinds
{
    public static function of(self|int $id): self
    {
        return $id instanceof self
            ? $id
            : self::findOrFail($id);
    }
}
