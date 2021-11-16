@if(!empty($wire_loading_spin))
    <span wire:loading.flex @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif  class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                 <x-icon class="animate-spin" vendor="fontawesome" set="solid" name="spinner"/>
            </span>
@endif
@if(!empty($icon))
    <span @if(!empty($wire_loading_spin)) wire:loading.class="opacity-0" @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif @endif  class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
            <x-icon :name="$icon"/>
        </span>
@endif
<span @if(!empty($wire_loading_spin) && empty($icon)) wire:loading.class="opacity-0" @if($wire_loading_spin!='all') wire:target="{{$wire_loading_spin}}" @endif @endif >{{ $slot }}</span>

