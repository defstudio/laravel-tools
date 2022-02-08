<div {{$attributes}}>
    @if(!empty($label))
        <label for="{{$id}}" class='block font-medium text-sm text-gray-700'>
            {{$label}}
        </label>
    @endif

    <input type="number"
           class='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'
           autocomplete="none"
           @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
    />

    @if($model)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
