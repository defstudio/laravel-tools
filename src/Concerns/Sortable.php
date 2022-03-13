<?php /** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpUnused */

namespace DefStudio\Tools\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait Sortable
{
    protected string $sort_attribute = 'position';

    public static function bootSortable(): void
    {
        static::creating(function (self $model) {
            $model->move_end();
        });

        static::deleted(function (self $model) {
            $model->recompute_sorting();
        });
    }

    /**
     * @return Builder<Model>
     */
    private function sort_query(): Builder
    {
        $query = self::query();

        /** @phpstan-ignore-next-line < */
        $this->sort_grouping($query);

        /** @phpstan-ignore-next-line */
        return $query;
    }

    /**
     * @param Builder<Model> $query
     */
    protected function sort_grouping(Builder $query): void
    {
        // No grouping by default
    }

    /**
     * @param Builder<Model> $query
     *
     * @phpstan-ignore-next-line
     */
    public function scopeSorted(Builder $query): void
    {
        $query->orderBy($this->sort_attribute);
    }

    public function move_up(): void
    {
        $swap_with = $this->sort_query()
            ->orderBy('position', 'desc')
            ->where('position', '<', $this->getAttribute($this->sort_attribute))
            ->limit(1)
            ->first();

        if ($swap_with === null) {
            return;
        }

        /** @phpstan-ignore-next-line */
        $this->swap_with($swap_with);
    }

    public function move_down(): void
    {
        $swap_with = $this->sort_query()
            ->orderBy('position')
            ->where('position', '>', $this->getAttribute($this->sort_attribute))
            ->limit(1)
            ->first();

        if ($swap_with === null) {
            return;
        }

        /** @phpstan-ignore-next-line */
        $this->swap_with($swap_with);
    }

    public function move_end(): void
    {
        $new_position = $this->sort_query()->max($this->sort_attribute) + 1;

        $this->setAttribute($this->sort_attribute, $new_position);

        if (empty($this->id)) {
            return;
        }

        $this->save();
    }

    public function recompute_sorting(): void
    {
        $this->sort_query()
            ->orderBy($this->sort_attribute)
            ->get()
            ->values()
            ->each(/** @phpstan-ignore-line */ function (self $model, int $index) {
                if ($model->id === $this->id) {
                    $this->setAttribute($this->sort_attribute, $index + 1);
                }

                $model->setAttribute($this->sort_attribute, $index + 1);
                $model->save();
            });
    }

    public function swap_with(self $other_model): void
    {
        $other_model_position = $other_model->getAttribute($this->sort_attribute);

        $other_model->setAttribute($this->sort_attribute, $this->getAttribute($this->sort_attribute));

        $this->setAttribute($this->sort_attribute, $other_model_position);

        $other_model->save();
        $this->save();
    }
}
