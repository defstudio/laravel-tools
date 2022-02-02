@php($confirmable_id = md5($attributes->wire('then')))

<span
    {{$attributes}}
    x-data
    x-on:click="$wire.start_confirming_action('{{ $confirmable_id }}', {{!empty($requiresPassword)}})"
    x-on:action-confirmed.window="setTimeout(() => $event.detail.id === '{{$confirmable_id}}' && $el.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{$slot}}
</span>

@once
    <x-modal wire:model="confirming_action" :color="$color">
        <x-slot name="title">{{$title}}</x-slot>
        {{$content}}
        
        @if($requiresPassword)
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700">{{$requiresPassword}}</label>
                <input type="text"
                       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                       autocomplete="none"
                       wire:model.defer="password_confirmation"
                >
            </div>
        @endif
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
