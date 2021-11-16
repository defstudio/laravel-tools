<?php

if ($attributes->wire('loading.spinner')->value) {
    $wire_loading_spin = $attributes->wire('click')->value;
}
?>

<button type="{{$type}}" {{ $attributes->merge(['class' => $base_class()]) }}>
    <x-button-content :wireLoadingSpin="$wire_loading_spin??''" :icon="$icon">{{$slot}}</x-button-content>
</button>

