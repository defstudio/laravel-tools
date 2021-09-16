@php($confirmable_id = md5($attributes->wire('then')))

<span
    {{$attributes}}
    x-ref="span"
    x-data
    x-on:click="$wire.start_confirming_action('{{ $confirmable_id }}')"
    x-on:action-confirmed.window="setTimeout(() => $event.detail.id === '{{$confirmable_id}}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{$slot}}
</span>

@once
    <x-modal wire:model="confirming_action">
        <x-slot name="title">{{$title}}</x-slot>
        {{$content}}
        <x-slot name="footer">
            <x-button color="secondary" wire:click="stop_confirming_action" wire:loading.attr="disabled">
                {{ $abortText }}
            </x-button>

            <x-button class="ml-auto" wire:click="confirmation_given" wire:loading.attr="disabled">
                {{$confirmText}}
            </x-button>
        </x-slot>
    </x-modal>
@endonce
