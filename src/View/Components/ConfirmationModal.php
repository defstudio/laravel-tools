<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace DefStudio\Tools\View\Components;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ConfirmationModal extends ModalComponent
{
    public string $confirmable_id;
    public string $requires_password;
    public string $password_confirmation = '';
    public string $title;
    public string $content;
    public string $color;
    public string $abort_text;
    public string $confirm_text;


    public function render(): View
    {
        return view('tools::confirmation-modal');
    }

    public function confirm(): void
    {
        if(!$this->confirm_password()){
            return;
        }

        $this->dispatchBrowserEvent('action-confirmed', [
            'id' => $this->confirmable_id,
        ]);

        $this->closeModal();
    }


    private function confirm_password(): bool
    {
        if (!$this->requires_password) {
            return true;
        }

        $guard = app(StatefulGuard::class);

        return $guard->validate([
            'email' => user()->email,
            'password' => $this->password_confirmation,
        ]);
    }
}
