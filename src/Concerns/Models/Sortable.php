<?php /** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpUnused */

namespace DefStudio\Tools\Concerns\Models;

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
            if(empty($model->position)){
                $model->move_end();
            }
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
     * @param iterable<int> $skip_ids
     */
    public function move_up(iterable $skip_ids = []): void
    {
        if(property_exists(static::class, '_fake') && self::$_fake){
            $this->position--;
            return;
        }

        /** @var Sortable $swap_with */
        $swap_with = $this->sort_query()
            ->orderBy($this->sort_attribute, 'desc')
            ->where($this->sort_attribute, '<', $this->getAttribute($this->sort_attribute))
            ->whereNotIn('id', $skip_ids)
            ->limit(1)
            ->first();

        if ($swap_with === null) {
            return;
        }
        
        $this->swap_with($swap_with);
    }

    /**
     * @param iterable<int> $skip_ids
     */
    public function move_down(iterable $skip_ids = []): void
    {
        if(property_exists(static::class, '_fake') && self::$_fake){
            $this->position++;
            return;
        }

        /** @var Sortable $swap_with */
        $swap_with = $this->sort_query()
            ->orderBy($this->sort_attribute)
            ->where($this->sort_attribute, '>', $this->getAttribute($this->sort_attribute))
            ->whereNotIn('id', $skip_ids)
            ->limit(1)
            ->first();

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
        if(property_exists(static::class, '_fake') && self::$_fake){
            $this->position = $position;
            return;
        }

        $this->setAttribute($this->sort_attribute, $position);
        $this->saveQuietly();

        $this->sort_query()
            ->orderBy($this->sort_attribute)
            ->where($this->sort_attribute, '>=', $position)
            ->where('id', '!=', $this->id)
            ->each(function(Model $other_model) use(&$position){
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
