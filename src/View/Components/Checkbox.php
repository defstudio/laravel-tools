<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Checkbox extends WiredInputComponent
{
    public function __construct(
        ?string $id = null,
        ?string $label = null,
        bool $live = false,
        bool $debounce = false,
        ?string $model = null,
        string $size = 'normal',
        bool $wFull = true,
        string $color = 'indigo',
        bool $showErrors = true,
        string $baseClass = '',
        public bool $alignWithOthers = false,
        public string|int $value = 1,
    ) {
        parent::__construct($id, $label, $live, $debounce, $model, $size, $wFull, $color, $showErrors, baseClass: $baseClass);
    }

}
