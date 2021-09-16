<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name,
        public string $set = 'heroicons',
        public string $style = 'outline',
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view("tools::icon");
    }
}
