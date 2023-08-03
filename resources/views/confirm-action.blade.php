@php($confirmable_id = md5($attributes->wire('then')))

<span
        {{$attributes}}
        x-data
        x-on:click="$wire.dispatch(
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
        x-on:action-confirmed.window="$event.detail[0].id === '{{$confirmable_id}}'  && $wire.{{$attributes->get('wire:then') }} "
>
    {{$slot}}
</span>
