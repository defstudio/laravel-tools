<?php

if ($attributes->wire('loading.spinner')->value === true) {
    $wire_loading_spin = $attributes->wire('click')->value;
}
?>

<button type="{{$type}}" {{ $attributes->merge(['class' => $base_class()]) }}>
    <x-button-content :wire-loading-spin="$wire_loading_spin??''" :icon="$icon">{{$slot}}</x-button-content>
</button>

