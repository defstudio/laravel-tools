<a {{ $attributes->merge(['class' => $base_class()]) }}>
    @if(!empty($icon))
        <x-icon wire:loading.remove wire:target="{!! $wireLoadingSpin !!}" :name="$icon"/>
    @endif
    {{ $slot }}
</a>
