<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Scripts extends Component
{
    public function __construct(
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::scripts');
    }
}
