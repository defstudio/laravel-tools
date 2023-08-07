
<label {{$attributes->class(['block font-medium text-sm text-gray-700'])}}>{{$slot}}
    @if($attributes->has('required') && $attributes->get('required'))
        <span class="text-red-500">&nbsp;*</span>
    @endif
</label>
