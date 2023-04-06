<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Button extends \Illuminate\View\Component
{
    public function __construct(
        public string $type = 'button',
        public string $color = 'primary',
        public string $size = 'normal',
        public string $icon = '',
    ) {
    }

    public function render(): Factory|View|Application
    {
        return view('tools::button');
    }

    public function base_class(): string
    {
        $color_classes = match ($this->color) {
            'primary' => 'bg-gray-800   border-transparent       text-white      hover:bg-gray-700 active:bg-gray-900  focus:border-gray-900  focus:ring-gray-300 ',
            'secondary' => 'bg-white      border-gray-300          text-gray-700   shadow-sm hover:text-gray-500         focus:border-blue-300  focus:ring-blue-200    active:text-gray-800 active:bg-gray-50 ',
            'danger' => 'bg-red-600    border-transparent       text-white      hover:bg-red-500                      focus:border-red-700   focus:ring-red-200     active:bg-red-600',
        };

        $size_classes = match ($this->size) {
            'sm' => 'px-2 py-1',
            'xs' => 'px-1 py-0.5',
            default => 'px-4 py-2'
        };

        return "relative inline-flex gap-1 items-center $size_classes border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition $color_classes";
    }
}
