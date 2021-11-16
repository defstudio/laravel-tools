<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;

class ButtonContent extends \Illuminate\View\Component
{
    public function __construct(
        public bool $wireLoadingSpin,
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::button-content');
    }
}
