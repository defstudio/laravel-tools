<?php

namespace DefStudio\Tools\Traits;

use Illuminate\Contracts\Auth\StatefulGuard;

/**
 * @mixin \Livewire\Component
 */
trait ConfirmsActions
{
    public bool $confirming_action = false;
    public string|null $confirmable_id = null;
    public bool $requires_password = false;
    public string $password_confirmation = '';

    public function start_confirming_action(string $confirmable_id, bool $requires_password): void
    {
        $this->confirming_action = true;
        $this->confirmable_id = $confirmable_id;
        $this->requires_password = $requires_password;
    }

    public function stop_confirming_action(): void
    {
        $this->confirming_action = false;
        $this->confirmable_id = null;
        $this->requires_password = false;
        $this->password_confirmation = '';
    }

    public function confirmation_given(): void
    {
        if(!$this->confirm_password()){
            return;
        }
        
        $this->dispatchBrowserEvent('action-confirmed', [
            'id' => $this->confirmable_id,
        ]);

        $this->stop_confirming_action();
    }
    
    public function confirm_password(): bool
    {
        if(!$this->requires_password){
            return true;
        }
        
        $user = user();
        
        $guard = app(StatefulGuard::class);
        
        return $guard->validate([
            'email' => $user->email,
            'password' => $this->password_confirmation,
        ]);
    }
}
