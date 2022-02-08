<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

abstract class WiredInputComponent extends Component
{
    public function __construct(
        public ?string $id = null,
        public ?string $label = null,
        public bool $defer = false,
        public ?string $model = null,
    ) {
        if(empty($this->id)){
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
}
