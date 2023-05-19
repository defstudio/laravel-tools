<?php

namespace DefStudio\Tools\View\Components;


class Select extends WiredInputComponent
{
    public function __construct(
        ?string $id = null,
        ?string $label = null,
        bool $defer = false,
        ?string $model = null,
        bool $wFull = true,
        string $size = 'normal',
        string $color = 'indigo',
        bool $showErrors = true,
        string $baseClass = '',
        public iterable $options = [],
        public string $unselected = '',
    ) {
        parent::__construct($id, $label, $defer, $model, $size, $wFull, $color, $showErrors, baseClass: $baseClass);
    }

    public function padding_x_class(): string
    {
        return "pl-2 pr-7";
    }
}
