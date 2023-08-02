<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\View\Component;

abstract class WiredInputComponent extends Component
{
    public function __construct(
        public ?string $id = null,
        public ?string $label = null,
        public bool $live = false,
        public ?string $model = null,
        public string $size = 'normal',
        public bool $wFull = true,
        public string $color = 'indigo',
        public bool $showErrors = true,
        public string $autocomplete = 'off',
        public string $hint = '',
        public string $baseClass = '',
    ) {
        if (empty($this->id)) {
            $this->id = $this->model ?? str($this->component_name())->append('-input-', Str::orderedUuid());
        }
    }

    /**
     * @inheritDoc
     */
    public function render(): View
    {
        return view('tools::'.$this->component_name());
    }

    protected function component_name(): string
    {
        return strtolower(ltrim(preg_replace('/([A-Z])/', '-\\1', class_basename(static::class)), '-'));
    }

    public function base_class($withBorders = true): string
    {
        return Collection::empty()
            ->push('block')
            ->push('text-gray-700')
            ->when($this->wFull, fn (Collection $classes) => $classes->push('w-full'))
            ->when($withBorders, fn (Collection $classes) => $classes->push("border border-gray-300 focus:border-$this->color-300"))
            ->when($withBorders, fn (Collection $classes) => $classes->push("focus:ring focus:ring-$this->color-200 focus:ring-opacity-50"))
            ->when($withBorders, fn (Collection $classes) => $classes->push("rounded-md"))
            ->when($withBorders, fn (Collection $classes) => $classes->push("shadow-sm"))
            ->when(!$withBorders, fn (Collection $classes) => $classes->push("bg-transparent border-0 focus:ring-0"))
            ->push($this->padding_class())
            ->push('disabled:bg-slate-50 disabled:text-slate-500 disabled:shadow-none disabled:rounded-md')
            ->push($this->baseClass)
            ->join(' ');
    }

    public function padding_class(): string
    {
        return "{$this->padding_x_class()} {$this->padding_y_class()}";
    }

    public function padding_x_class(): string
    {
        return match ($this->size) {
            'sm' => 'px-1',
            default => 'px-2',
        };
    }

    public function padding_y_class(): string
    {
        return match ($this->size) {
            'sm' => 'py-1',
            default => 'py-2',
        };
    }
}
