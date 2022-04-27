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
        "relative rounded-md shadow-sm",
        $wFull => 'w-full',
    ])>
        @if(isset($prefix) && $prefix->isNotEmpty())
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm"> {{$prefix}} </span>
            </div>
        @endif
        <input id="{{$id}}"
               type="number"
               autocomplete="off"
               class='{{$base_class()}} {{isset($prefix) && $prefix->isNotEmpty() ? 'pl-7': ''}} {{isset($postfix) && $postfix->isNotEmpty() ? 'pr-7': ''}}'
               @if($min!==null)min="{{$min}}"@endif
               @if($max!==null)max="{{$max}}"@endif
               @if($step!==null)step="{{$step}}"@endif
               @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
        />
        @if(isset($postfix) && $postfix->isNotEmpty())
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm"> {{$postfix}} </span>
            </div>
        @endif
    </div>

    @if($model)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
