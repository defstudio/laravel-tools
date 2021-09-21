<?php
/** @var string $color */
/** @var string $size */


$color_classes = match ($color) {
    'primary' => 'bg-gray-800   border-transparent       text-white      hover:bg-gray-700 active:bg-gray-900  focus:border-gray-900  focus:ring-gray-300 ',
    'secondary' => 'bg-white      border-gray-300          text-gray-700   shadow-sm hover:text-gray-500         focus:border-blue-300  focus:ring-blue-200    active:text-gray-800 active:bg-gray-50 ',
    'danger' => 'bg-red-600    border-transparent       text-white      hover:bg-red-500                      focus:border-red-700   focus:ring-red-200     active:bg-red-600',
};

$size_classes = match ($size) {
    'sm' => 'px-2 py-1',
    default => 'px-4 py-2'
};

$class = "relative inline-flex items-center $size_classes border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition $color_classes";


if ($attributes->wire('loading.spinner')->value === true) {
    $wire_loading_spin = $attributes->wire('click')->value;
}


?>

@if($type == 'link')
    <a {{ $attributes->merge(['class' => $class]) }}>
        @if(!empty($wire_loading_spin))
            <span wire:loading.flex @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif  class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                 <x-icon class="animate-spin" vendor="fontawesome" set="solid" name="spinner"/>
            </span>
        @endif
        <span @if(!empty($wire_loading_spin)) wire:loading.class="opacity-0" @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif @endif >{{ $slot }}</span>
    </a>
@else
    <button type="{{$type}}" {{ $attributes->merge(['class' => $class]) }}>
        @if(!empty($wire_loading_spin))
            <span wire:loading.flex @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif  class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                 <x-icon class="animate-spin" vendor="fontawesome" set="solid" name="spinner"/>
            </span>
        @endif
        <span @if(!empty($wire_loading_spin)) wire:loading.class="opacity-0" @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif @endif >{{ $slot }}</span>
    </button>
@endif
