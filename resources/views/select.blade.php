<div {{$attributes}}>
    @if(!empty($label))
        <label for="{{$id}}" class='block font-medium text-sm text-gray-700'>
            {{$label}}
        </label>
    @endif

    <select id="{{$id}}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
    >
        @if(!empty($unselected))
            <option value="">{{$unselected}}</option>
        @endif
        @foreach($options as $value => $label)
            @if(is_array($label))

                <optgroup label="{{$value}}">
                    @foreach($label as $suboption_value => $suboption_label)
                        <option value="{{$suboption_value}}">{{$suboption_label}}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{$value}}">{{$label}}</option>
            @endif

        @endforeach
    </select>

    @if($model)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif

</div>
