<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Text extends Component
{
    public function __construct(
        public string|null $id = null,
        public string|null $label = null,
        public bool $defer = false,
        public string|null $model = null,
    ) {
        if(empty($this->id)){
            $this->id = $this->model ?? str('text-input')->append('-', Str::orderedUuid());
        }
    }

    public function render(): Factory|View|Application
    {
        return view('tools::text-area');
    }
}
