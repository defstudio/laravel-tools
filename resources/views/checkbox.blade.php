<?php
$disabled = $attributes->get('disabled', false);
$required = $attributes->get('required', false);
$attributes = $attributes->except(['disabled', '$required']);
?>

<div {{$attributes->class('flex flex-col h-full')}}>
    @if($alignWithOthers)
        <label>&nbsp;</label>
    @endif
    
    <div class="grow">
        <div>
            <input id="{{$id}}"
                   type="checkbox"
                   value="{{$value}}"
                   class='peer rounded border-gray-300 disabled:border-gray-200 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer'
                   {{$disabled ? 'disabled' : ''}}
                   {{$required ? 'required' : ''}}
                   @if($model)wire:model{{$live ? '.live' : ''}}{{$debounce ? '.debounce' : ''}}="{{$model}}"@endif
            />
            
            @if(!empty($label))
                <x-label for="{{$id}}" class="peer-disabled:text-gray-400 cursor-pointer">&nbsp;{{$label}}</x-label>
            @endif
        </div>
        
        
        @if($model && $showErrors)
            @error($model)
            <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
            @enderror
        @endif
    </div>

</div>
