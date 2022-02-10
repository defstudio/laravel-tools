<a {{ $attributes->merge(['class' => $base_class()]) }}>
    @if(!empty($icon))
        <x-icon wire:loading.remove :name="$icon"/>
    @endif
    {{ $slot }}
</a>
