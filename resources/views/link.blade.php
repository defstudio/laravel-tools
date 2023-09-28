<a {{ $attributes->merge(['class' => $base_class()]) }}>
    @if(!empty($icon))
        <x-icon :name="$icon"/>
    @endif
    {{ $slot }}
</a>
