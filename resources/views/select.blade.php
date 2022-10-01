<?php
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
    
    <select id="{{$id}}"
            
            @class([
                '{{$base_class()}} cursor-pointer',
                $disabled => "disabled:bg-slate-50"
            ])
            @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
            {{$disabled ? 'disabled' : ''}}
            {{$required ? 'required' : ''}}
    >
        @if(isset($slot) && $slot->isNotEmpty())
            {{$slot}}
        @else
            @if(!empty($unselected))
                <option value="">{{$unselected}}</option>
            @endif
            @foreach($options as $value => $label)
                @if(is_array($label))
                    @if(count($label) > 0)
                        <optgroup label="{{$value}}">
                            @foreach($label as $suboption_value => $suboption_label)
                                <option value="{{$suboption_value}}">{{$suboption_label}}</option>
                            @endforeach
                        </optgroup>
                    @endif
                @else
                    <option value="{{$value}}">{{$label}}</option>
                @endif
            
            @endforeach
        @endisset
    </select>
    
    @if($model && $showErrors)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
