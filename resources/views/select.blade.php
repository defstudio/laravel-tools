<select {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
>
    @if(!empty($unselected))
        <option value="">{{$unselected}}</option>
    @endif
    @foreach($options as $value => $label)
        <option value="{{$value}}">{{$label}}</option>
    @endforeach
</select>
