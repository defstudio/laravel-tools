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
        <x-label for="{{$id}}" :required="$attributes->has('required') && $attributes->get('required')">{{$label}}</x-label>
    @endif
    
    <div @class([
        'overflow-hidden',
        $wFull => 'w-full',
        "flex rounded-md shadow-sm",
        "border border-gray-300 focus:border-$color-300",
        "focus:ring focus:ring-$color-200 focus:ring-opacity-50",
    ])>
        @if(isset($prefix) && $prefix->isNotEmpty())
            <div {{$prefix->attributes->class([
                    "pointer-events-none" => !$prefix->attributes->get('pointer-events', false),
                    "p-1 flex items-center"
            ])}}>
                <span class="text-gray-500 sm:text-sm">{{$prefix}}</span>
            </div>
        @endif
        <input id="{{$id}}"
               type="file"
               autocomplete="{{$autocomplete}}"
               placeholder="{{$hint}}"
               {{$disabled ? 'disabled' : ''}}
               {{$required ? 'required' : ''}}
               @class([
                     'file:h-10' => $size !== 'sm',
                     'file:h-8' => $size === 'sm',
                     'file:-ml-2' => $size !== 'sm',
                     'file:-ml-1' => $size === 'sm',
                     'file:-mt-2' => $size !== 'sm',
                     'file:-mt-1' => $size === 'sm',
                     'file:-mb-2' => $size !== 'sm',
                     'file:-mb-1' => $size === 'sm',
                     $base_class(false),
                     'cursor-pointer',
                     'file:cursor-pointer',
                     'file:border-0',
                     'file:text-gray-700',
               ])
               {{$multiple ? 'multiple' : ''}}
               {{$accept ? "accept=$accept" : ""}}
               @if($model)wire:model{{$live ? '.live' : ''}}{{$debounce ? '.debounce' : ''}}="{{$model}}"@endif
        />
        
        @if(isset($postfix) && $postfix->isNotEmpty())
            <div {{$postfix->attributes->class([
                "pointer-events-none" => !$postfix->attributes->get('pointer-events', false),
                "p-1 flex items-center"
            ])}}>
                <span class="text-gray-500 sm:text-sm">{{$postfix}}</span>
            </div>
        @endif
    </div>
    
    @if($model && $showErrors)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
