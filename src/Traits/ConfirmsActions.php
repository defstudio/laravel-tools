<?php

namespace DefStudio\Tools\Traits;

/**
 * @mixin \Livewire\Component
 */
trait ConfirmsActions
{
    public bool $confirming_action = false;
    public string|null $confirmable_id = null;

    public function start_confirming_action(string $confirmable_id): void
    {
        $this->confirming_action = true;
        $this->confirmable_id = $confirmable_id;

        $this->dispatchBrowserEvent('confirming-action');
    }

    public function stop_confirming_action(): void
    {
        $this->confirming_action = false;
        $this->confirmable_id = null;
    }

    public function confirmation_given(): void
    {
        $this->dispatchBrowserEvent('action-confirmed', [
            'id' => $this->confirmable_id,
        ]);

        $this->stop_confirming_action();
    }
}
