<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string|null $id = null,
        public string|null $maxWidth = '2xl',
        public string $color = 'none',
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::modal');
    }
}
