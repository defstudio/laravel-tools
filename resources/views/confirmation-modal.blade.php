<x-wire-modal :title="$title" grid="0">
    {{$content}}
    
    @if($requires_password)
        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700">{{$requires_password}}</label>
            <input type="text"
                   class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                   autocomplete="off"
                   style="-webkit-text-security: disc;"
                   wire:model.defer="password_confirmation"
            >
        </div>
    @endif
    
    <x-slot name="actions">
        <x-button :color="$color ?? 'primary'" wire:click="confirm" wire:loading.disable>
            {{$confirm_text}}
        </x-button>
        
        <x-button color="secondary" wire:click="$emit('closeModal')" wire:loading.disable>
            {{ $abort_text }}
        </x-button>
    </x-slot>
</x-wire-modal>
