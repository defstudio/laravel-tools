<?php

namespace DefStudio\Tools\Concerns\Livewire;

use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;

/**
 * @property-read boolean $valid
 */
trait ChecksValidity
{
    #[Computed]
    public function valid(): bool
    {
        try {
            $this->validate();
            return true;
        }catch (ValidationException){
            return false;
        }
    }
}
