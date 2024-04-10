<?php

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmAction extends Component
{
    public function __construct(
        public string $title = 'Confirm',
        public string $content = 'Do you really want it?',
        public string $confirmText = 'Confirm',
        public string $abortText = 'No, Abort',
        public string $color = 'none',
        public string|bool $requiresPassword = '',
    ) {
        if ($this->requiresPassword === true) {
            $this->requiresPassword = 'Please confirm your password to continue';
        }

        if ($this->requiresPassword === false) {
            $this->requiresPassword = '';
        }

    }

    public function render(): Factory|View|Application
    {
        return view("tools::confirm-action");
    }
}
