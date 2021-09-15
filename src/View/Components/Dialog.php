<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Dialog extends \Illuminate\View\Component
{
    public function __construct(
        public string|null $id = null,
        public string|null $maxWidth = null,
    ) {

        if ($this->id === null) {
            /** @var \Illuminate\View\ComponentAttributeBag $attributes */
            $attributes = $this->data()['attributes'];
            $this->id = md5($attributes->wire('model'));
        }

        $this->maxWidth ??= '2xl';
        $this->maxWidth = match ($this->maxWidth) {
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-md',
            'lg' => 'sm:max-w-lg',
            'xl' => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
        };
    }

    public function render(): Factory|View|Application
    {
        return view('tools::dialog');
    }
}
