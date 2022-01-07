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
        public string $vendor = 'heroicons',
        public string $set = 'outline',
        public string $size = '6'
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view("tools::icons.$this->vendor.$this->set.$this->name");
    }
}
