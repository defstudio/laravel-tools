@php($confirmable_id = md5($attributes->wire('then')))

<span
    {{$attributes}}
    x-data
    x-on:click="Livewire.$dispatch(
                    'openModal',
                    {{json_encode([
                            'component' => 'confirmation-modal',
                            'arguments' => [
                                'confirmable_id' => $confirmable_id,
                                'requires_password' => $requiresPassword,
                                'title' => $title,
                                'content' => $content,
                                'color' => $color,
                                'abort_text' => $abortText,
                                'confirm_text' => $confirmText,
                            ]
                    ])}}
        )"
    x-on:action-confirmed.window="setTimeout(() => $event.detail.id === '{{$confirmable_id}}' && $el.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{$slot}}
</span>
