<?php
/** @var \Illuminate\View\ComponentAttributeBag $attributes */
?>

<div {{$attributes->class(['p-2' => $withPadding])}}>
    @if($xClose)
        <div wire:click="$emit('closeModal')" class="absolute top-0 right-0 w-6 h-6 rounded-bl-lg border shadow bg-gray-100 flex justify-center items-center cursor-pointer">
            <x-icon size="4" name="x"/>
        </div>
    @endif
    
    @if(!empty($title) || !empty($rightTitle))
        <div class="mb-4 flex justify-between">
            @if(!empty($title))
                <div class="text-lg underline">
                    {{$title}}
                </div>
            @endif
            
            @if(!empty($rightTitle))
                <div>
                    {{$rightTitle}}
                </div>
            @endif
        </div>
    
    @endif
    
    <div {{$attributes->class($grid ? "md:grid md:grid-cols-$grid md:gap-6" : '')}}>
        {{$slot}}
    </div>
    
    @if(!empty($actions))
        <div class="mt-6 flex flex-row-reverse justify-between">
            @if(is_array($actions))
                @foreach($actions as $label => $action)
                    <x-button wire:click="{{$action}}" wire:loading.disable>{{$label}}</x-button>
                @endforeach
            @else
                {{$actions ?? ''}}
            @endisset
        </div>
    @endif
</div>
