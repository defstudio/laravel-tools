<div {{$attributes}}>
    @if(!empty($label))
        <label for="{{$id}}" class='block font-medium text-sm text-gray-700'>
            {{$label}}
            @if($attributes->has('required') && $attributes->get('required'))
                <span class="text-red-500">&nbsp;*</span>
            @endif
        </label>
    @endif

    <input id="{{$id}}"
           type="text"
           class='{{$base_class()}}'
           autocomplete="off"
           @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
    />

    @if($model)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
