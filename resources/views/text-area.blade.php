<?php
$disabled = $attributes->get('disabled', false);
$required = $attributes->get('required', false);
$attributes = $attributes->except(['disabled', '$required']);
?>

<div {{$attributes}}>
    @if(!empty($label))
        <x-label for="{{$id}}" :required="$attributes->has('required') && $attributes->get('required')">{{$label}}</x-label>
    @endif
    
    <div @class([
        'overflow-hidden',
        'w-full' => $wFull,
        "flex rounded-md shadow-sm",
        "border border-gray-300 focus:border-$color-300",
        "focus:ring focus:ring-$color-200 focus:ring-opacity-50",
    ])>
    <textarea id="{{$id}}"
              class='{{$base_class(false)}}'
              placeholder="{{$hint}}"
              {{$disabled ? 'disabled' : ''}}
              {{$required ? 'required' : ''}}
              @if($model)wire:model{{$live ? '.live' : ''}}{{$debounce ? '.debounce' : ''}}="{{$model}}"@endif
    >{!! $slot !!}</textarea>
    </div>
    @if($model && $showErrors)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif
</div>
