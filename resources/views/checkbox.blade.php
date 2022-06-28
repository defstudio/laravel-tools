<div {{$attributes->class('flex flex-col h-full')}}>
    @if($alignWithOthers)
        <label>&nbsp;</label>
    @endif
    
    <div class="grow flex items-center">
        <input id="{{$id}}"
               type="checkbox"
               class='rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer'
               autocomplete="none"
               @if($model)wire:model{{$defer ? '.defer' : ''}}="{{$model}}"@endif
        />
        
        @if(!empty($label))
            @if(is_string($label))
                <label for="{{$id}}" class='font-medium text-sm text-gray-700 cursor-pointer'>
                    &nbsp;{{$label}}
                </label>
            @else
                {{$label}}
            @endif
        @endif
        
        @if($model && $showErrors)
            @error($model)
            <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
            @enderror
        @endif
    </div>

</div>
