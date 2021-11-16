<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JetBrains\PhpStorm\Pure;

class Link extends Button
{
    #[Pure] public function __construct(
        public string $color = 'primary',
        public string $size = 'normal',
        public string $icon = '',
    ) {
        parent::__construct(
            'link',
            $this->color,
            $this->size,
            $this->icon
        );
    }

    public function render(): Factory|View|Application
    {
        return view('tools::link');
    }
}
