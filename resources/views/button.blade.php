<?php
/** @var ComponentAttributeBag $attributes */

use Illuminate\View\ComponentAttributeBag;

$wire_loading_disabled = $attributes->wire('loading.disable')->value;
$attributes            = $attributes->except('wire:loading.disable');

if (!empty($wire_loading_disabled)) {
    $attributes = $attributes->merge(['wire:loading.attr' => 'disabled']);

    if ($wire_loading_disabled === true) {
        $wire_loading_target = $attributes->wire('click')->value;
    }else if ($wire_loading_disabled !== 'all') {
        $wire_loading_target = $wire_loading_disabled;
    }

    if (!empty($wire_loading_target)) {
        $attributes = $attributes->merge(['wire:loading.target' => $wire_loading_target]);
    }
}
?>

<button type="{{$type}}"
    {{ $attributes->merge(['class' => $base_class()])}}>
    @if(!empty($icon))
        <x-icon wire:loading.remove wire:target="{!! $wireLoadingSpin !!}" :name="$icon"/>
    @endif
    {{ $slot }}
</button>
