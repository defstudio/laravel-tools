<?php

namespace DefStudio\Tools\View\Components;


class Select extends WiredInputComponent
{
    public function __construct(
        ?string $id = null,
        ?string $label = null,
        bool $defer = false,
        ?string $model = null,
        public iterable $options = [],
        public string $unselected = '',
        public bool $wFull = true,
    ) {
        parent::__construct($id, $label, $defer, $model);
    }
}
