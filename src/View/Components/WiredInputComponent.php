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
        public bool $defer = false,
        public ?string $model = null,
        public string $size = 'normal',
        public bool $wFull = true,
        public string $color = 'indigo',
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
        return view('tools::' . $this->component_name());
    }

    protected function component_name(): string
    {
        return strtolower(ltrim(preg_replace('/([A-Z])/', '-\\1', class_basename(static::class)), '-'));
    }

    public function base_class(): string
    {
        return Collection::empty()
            ->push('block')
            ->when($this->wFull, fn (Collection $classes) => $classes->push('w-full'))
            ->push("border-gray-300 focus:border-$this->color-300")
            ->push("focus:ring focus:ring-$this->color-200 focus:ring-opacity-50")
            ->push('rounded-md')
            ->push('shadow-sm')
            ->push($this->padding_class())
            ->join(' ');
    }

    public function padding_class(): string
    {
        return "{$this->padding_x_class()} {$this->padding_y_class()}";
    }

    public function padding_x_class(): string
    {
        return match ($this->size) {
            'sm' => 'px-2',
            default => 'px-4',
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
