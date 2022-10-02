<?php /** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpUnused */

namespace DefStudio\Tools\Concerns\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Closure;
use Illuminate\Support\Collection;

/**
 * @mixin Model
 */
trait Sortable
{
    protected string $sort_attribute = 'position';

    public static function bootSortable(): void
    {
        static::creating(function (self $model) {
            if (empty($model->position)) {
                $model->move_end();
                return;
            }

            $position = $model->position;

            $model->sort_query()
                ->orderBy($model->sort_attribute)
                ->where($model->sort_attribute, '>=', $position)
                ->each(function (Model $other_model) use (&$position, $model) {
                    $other_model->setAttribute($model->sort_attribute, ++$position);
                    $other_model->saveQuietly();
                });
        });

        static::deleted(function (self $model) {
            $model->recompute_sorting();
        });
    }

    /**
     * @param callable(static $sortable): bool $filter
     */
    public static function move_group_down(Collection $group, Closure $filter = null): void
    {
        if($group->isEmpty()){
            return;
        }

        $group = $group->sortByDesc($group->first()->sort_attribute);

        /** @var Sortable $pivot */
        $pivot = $group->first();

        $target_position = $pivot->next($filter)?->getAttribute($pivot->sort_attribute);

        $target_position ??= $pivot->sort_query()
                ->orderByDesc($pivot->sort_attribute)
                ->first()?->getAttribute($pivot->sort_attribute) + 1;


        if($target_position === null){
            return;
        }


        $group->each(function($sortable) use (&$target_position){
            $sortable->move_at($target_position--);
        });
    }

    /**
     * @param callable(static $sortable): bool $filter
     */
    public static function move_group_up(Collection $group, Closure $filter = null): void
    {
        if($group->isEmpty()){
            return;
        }

        $group = $group->sortBy($group->first()->sort_attribute);

        /** @var Sortable $pivot */
        $pivot = $group->first();

        $target_position = $pivot->previous($filter)?->getAttribute($pivot->sort_attribute) ?? 0;
        $target_position++;

        $group->each(function($sortable) use (&$target_position){
            $sortable->move_at($target_position++);
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

    /**
     * @param Builder<Model> $query
     *
     * @phpstan-ignore-next-line
     */
    public function scopeSortedDesc(Builder $query): void
    {
        $query->orderByDesc($this->sort_attribute);
    }

    /**
     * @param callable(static $sortable): bool $filter
     */
    public function previous(Closure $filter = null): static|null
    {
        if (property_exists(static::class, '_fake') && self::$_fake) {
            return null;
        }

        if($filter === null){
            /** @phpstan-ignore-next-line */
            return $this->sort_query()
                ->orderBy($this->sort_attribute, 'desc')
                ->where($this->sort_attribute, '<', $this->getAttribute($this->sort_attribute))
                ->limit(1)
                ->first();
        }

        $current = $this;
        while(($current = $current->previous()) !== null){
            if($filter($current)){
                return $current;
            }
        }

        return null;
    }

    /**
     * @param callable(static $sortable): bool $filter
     */
    public function next(Closure $filter = null): static|null
    {
        if (property_exists(static::class, '_fake') && self::$_fake) {
            return null;
        }

        if($filter === null){
            /** @phpstan-ignore-next-line */
            return $this->sort_query()
                ->orderBy($this->sort_attribute)
                ->where($this->sort_attribute, '>', $this->getAttribute($this->sort_attribute))
                ->limit(1)
                ->first();
        }

        $current = $this;
        while(($current = $current->next()) !== null){
            if($filter($current)){
                return $current;
            }
        }

        return null;
    }

    /**
     * @param callable(static $sortable): bool $filter
     */
    public function move_up(Closure $filter = null): void
    {
        if (property_exists(static::class, '_fake') && self::$_fake) {
            $this->position--;
            return;
        }

        /** @var Sortable $swap_with */
        $swap_with = $this->previous($filter);

        if ($swap_with === null) {
            return;
        }

        $this->swap_with($swap_with);
    }

    /**
     * @param callable(static $sortable): bool $filter
     */
    public function move_down(Closure $filter = null): void
    {
        if (property_exists(static::class, '_fake') && self::$_fake) {
            $this->position++;
            return;
        }

        /** @var Sortable $swap_with */
        $swap_with = $this->next($filter);

        if ($swap_with === null) {
            return;
        }

        $this->swap_with($swap_with);
    }

    public function move_end(): void
    {
        $new_position = $this->sort_query()->max($this->sort_attribute) + 1;

        $this->setAttribute($this->sort_attribute, $new_position);

        if (empty($this->id)) {
            return;
        }

        $this->saveQuietly();
    }

    public function move_at(int $position): void
    {
        if (property_exists(static::class, '_fake') && self::$_fake) {
            $this->position = $position;
            return;
        }

        $this->setAttribute($this->sort_attribute, $position);
        $this->saveQuietly();

        $this->sort_query()
            ->orderBy($this->sort_attribute)
            ->where($this->sort_attribute, '>=', $position)
            ->where('id', '!=', $this->id)
            ->each(function (Model $other_model) use (&$position) {
                $other_model->setAttribute($this->sort_attribute, ++$position);
                $other_model->saveQuietly();
            });

        $this->recompute_sorting();

    }

    public function recompute_sorting(): void
    {
        $this->sort_query()
            ->orderBy($this->sort_attribute)
            ->get()
            ->values()
            ->each(function (self $model, int $index) {
                $model->setAttribute($this->sort_attribute, $index + 1);
                $model->saveQuietly();
            });
    }

    public function swap_with(self $other_model): void
    {
        $other_model_position = $other_model->getAttribute($this->sort_attribute);

        $other_model->setAttribute($this->sort_attribute, $this->getAttribute($this->sort_attribute));

        $this->setAttribute($this->sort_attribute, $other_model_position);

        $other_model->saveQuietly();
        $this->saveQuietly();
    }
}
