<?php

namespace DefStudio\Tools\Concerns;

use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

/**
 * @mixin Model
 */
trait Fakeable
{
    private static bool $_fake = false;

    private int $_times_saved = 0;

    private bool $_forceDeleted = false;

    public static function fake(): void
    {
        self::$_fake = true;
    }

    public function save(array $options = []): bool
    {
        if (!self::$_fake) {
            return parent::save($options);
        }

        $this->id ??= rand();

        $this->_times_saved++;
        $this->exists = true;

        return true;
    }

    public function delete(): bool
    {
        if (!self::$_fake) {
            return parent::delete();
        }

        if(property_exists($this, 'forceDeleting') && $this->forceDeleting){
            $this->_forceDeleted = true;
        }

        $this->exists = false;
        return true;
    }

    public function assertSaved(int $times = 1): void
    {
        $message = $times == 1
            ? sprintf("Failed asserthing that [%s] was saved", $this::class)
            : sprintf("Failed asserthing that [%s] was saved %d times (actually was saved %d times)", $this::class, $times, $this->_times_saved);

        assertTrue($this->_times_saved >= $times, $message);
    }

    public function assertDeleted(): void
    {
        assertFalse($this->exists, sprintf("Failed asserting that [%s] was deleted", $this::class));
    }

    public function assertForceDeleted(): void
    {
        assertTrue($this->_forceDeleted, sprintf("Failed asserting that [%s] was force deleted", $this::class));
    }
}
