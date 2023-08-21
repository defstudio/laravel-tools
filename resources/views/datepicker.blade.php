<?php

use Illuminate\View\ComponentSlot;

/** @var ComponentSlot $prefix */
/** @var ComponentSlot $postfix */

$disabled = $attributes->get('disabled', false);
$required = $attributes->get('required', false);
$attributes = $attributes->except(['disabled', '$required']);
?>


<div {{$attributes}}>
    @if(!empty($label))
        <label for="{{$id}}" class='block font-medium text-sm text-gray-700'>
            {{$label}}
            @if($attributes->has('required') && $attributes->get('required'))
                <span class="text-red-500">&nbsp;*</span>
            @endif
        </label>
    @endif

    <div @class([
        'w-full' => $wFull,
        "flex rounded-md shadow-sm",
        "border border-gray-300 focus:border-$color-300",
        "focus:ring focus:ring-$color-200 focus:ring-opacity-50",
    ])>
        @if(isset($prefix) && $prefix->isNotEmpty())
            <div @class([
                "pointer-events-none" => !$prefix->attributes->get('pointer-events', false),
                "pr-2 flex items-center"
            ])>
                <span class="text-gray-500 sm:text-sm"> {{$prefix}} </span>
            </div>
        @endif
        <input id="{{$id}}"
               type="date"
               autocomplete="{{$autocomplete}}"
               placeholder="{{$hint}}"
               class='{{$base_class(false)}}'
               {{$disabled ? 'disabled' : ''}}
               {{$required ? 'required' : ''}}
               @if($model)wire:model{{$defer ? '.defer' : ''}}{{$debounce ? '.debounce' : ''}}="{{$model}}"@endif
        />
        @if(isset($postfix) && $postfix->isNotEmpty())
            <div @class([
                "pointer-events-none" => !$postfix->attributes->get('pointer-events', false),
                "pr-2 flex items-center"
            ])>
                <span class="text-gray-500 sm:text-sm"> {{$postfix}} </span>
            </div>
        @endif
    </div>

    @if($model && $showErrors)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
