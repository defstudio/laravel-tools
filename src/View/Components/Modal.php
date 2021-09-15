<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Modal extends \Illuminate\View\Component
{
    public function __construct(
        public string|null $id = null,
        public string|null $maxWidth = null,
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::modal');
    }
}
