<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Card extends Component
{
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function render(): Factory|View|Application
    {
        return view('tools::card');
    }
}
