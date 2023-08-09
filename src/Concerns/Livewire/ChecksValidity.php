<?php

namespace DefStudio\Tools\Concerns\Livewire;

use Illuminate\Validation\ValidationException;

/**
 * @property-read boolean $valid
 */
trait ChecksValidity
{
    public $valid = true;

    public function updatedChecksValidity(): void
    {
        try {
            $this->validate();
            $this->valid = true;
        }catch (ValidationException $exception){
            $this->setErrorBag($exception->validator->errors());
            $this->valid = false;
        }
    }
}
