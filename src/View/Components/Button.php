<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Button extends \Illuminate\View\Component
{
    public function __construct(
        public string $type = 'button',
        public string $color = 'primary',
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::button');
    }
}
