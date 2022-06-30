<?php

use Illuminate\View\ComponentSlot;

/** @var ComponentSlot $prefix */
/** @var ComponentSlot $postfix */
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
        "flex rounded-md shadow-sm",
        $wFull => 'w-full',
        "border border-gray-300 focus:border-$color-300",
        "focus:ring focus:ring-$color-200 focus:ring-opacity-50",
    ])>
        @if(isset($prefix) && $prefix->isNotEmpty())
            <div class="pl-2 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm"> {{$prefix}} </span>
            </div>
        @endif
        <input id="{{$id}}"
               type="file"
               autocomplete="{{$autocomplete}}"
               placeholder="{{$hint}}"
               @class([
                     $base_class(false),
                     'cursor-pointer',
                     'file:cursor-pointer',
                     'file:border-0',
                     'file:text-gray-700',
                     'file:h-10' => $size !== 'sm',
                     'file:h-8' => $size === 'sm',
                     'file:-ml-2' => $size !== 'sm',
                     'file:-ml-1' => $size === 'sm',
                     'file:-mt-2' => $size !== 'sm',
                     'file:-mt-1' => $size === 'sm',
                     'file:-mb-2' => $size !== 'sm',
                     'file:-mb-1' => $size === 'sm',
               ])
               {{$multiple ? 'multiple' : ''}}
               {{$accept ? "accept='$accept'" : ""}}
               @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
        />
        
        @if(isset($postfix) && $postfix->isNotEmpty())
            <div class="pr-2 flex items-center pointer-events-none">
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
