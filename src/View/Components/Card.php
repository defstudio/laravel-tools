<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public bool $collapsable = false,
        public bool $collapsed = false,
    ) {
        if($this->collapsable){
            $this->collapsed = false;
        }else{
            if ($this->collapsed) {
                $this->collapsable = true;
            }
        }
    }

    public function render(): Factory|View|Application
    {
        return view('tools::card');
    }
}
