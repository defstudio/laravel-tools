<?php
/** @var string $color */
/** @var string $size */


$color_classes = match ($color) {
    'primary' =>   'bg-gray-800   border-transparent       text-white      hover:bg-gray-700 active:bg-gray-900  focus:border-gray-900  focus:ring-gray-300 ',
    'secondary' => 'bg-white      border-gray-300          text-gray-700   shadow-sm hover:text-gray-500         focus:border-blue-300  focus:ring-blue-200    active:text-gray-800 active:bg-gray-50 ',
    'danger' =>    'bg-red-600    border-transparent       text-white      hover:bg-red-500                      focus:border-red-700   focus:ring-red-200     active:bg-red-600',
};

$size_classes = match ($size){
    'sm' => 'px-1 py-1',
    default => 'px-4 py-2'
};

$class = "inline-flex items-center $size_classes border rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition $color_classes";
?>

@if($type == 'link')
    <a {{ $attributes->merge([
    'class' => $class
]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{$type}}" {{ $attributes->merge([
    'class' => $class
]) }}>
        {{ $slot }}
    </button>
@endif
