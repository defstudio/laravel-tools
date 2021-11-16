<?php

if ($attributes->wire('loading.spinner')->value === true) {
    $wire_loading_spin = $attributes->wire('click')->value;
}

?>

<a {{ $attributes->merge(['class' => $class]) }}>
    <x-button-content :wire-loading-spin="$wire_loading_spin??''">{{$slot}}</x-button-content>
</a>
