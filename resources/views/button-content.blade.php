@if(!empty($wireLoadingSpin))
    <x-icon wire:loading wire:target="{!! $wireLoadingSpin !!}" class="animate-spin" vendor="fontawesome" set="solid" name="spinner"/>
@endif
@if(!empty($icon))
    <x-icon wire:loading.remove wire:target="{!! $wireLoadingSpin !!}" :name="$icon"/>
@endif
<span @if(!empty($wireLoadingSpin) && empty($icon)) wire:loading.remove @if($wireLoadingSpin!='all') wire:target="{!! $wireLoadingSpin !!}" @endif @endif >{{ $slot }}</span>

