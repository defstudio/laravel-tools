<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WireModal extends Component
{
    public function __construct(
        public string $title = '',
        public int $grid = 6,
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::wire-modal');
    }
}
