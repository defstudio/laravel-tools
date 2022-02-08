<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends WiredInputComponent
{
    public function __construct(
        ?string $id = null,
        ?string $label = null,
        bool $defer = false,
        ?string $model = null,
        public iterable $options = [],
        public string $unselected = '',
    )
    {
        parent::__construct($id, $label, $defer, $model);
    }
}
