<?php
/** @var ComponentAttributeBag $attributes */

use Illuminate\View\ComponentAttributeBag;

if ($attributes->wire('loading.spinner')->value) {
    $wire_loading_spin = $attributes->wire('click')->value;
}

if ($attributes->wire('loading.disabled')->value) {
    $wire_loading_disabled = $attributes->wire('click')->value;
}
?>

<button type="{{$type}}" {{ $attributes->merge(['class' => $base_class()]) }}>
    <x-button-content
        :wireLoadingSpin="$wire_loading_spin??''"
        @if($wire_loading_disabled) wire:loading.attr="disabled" @endif
        :icon="$icon">{{$slot}}</x-button-content>
</button>

