<div x-data="{
            show:{{$collapsed?'false':'true'}},
            collapsable:{{$collapsable?'true':'false'}}
    }">
    @if(isset($header))
        <div @click='show=!show'
            @class([
               'flex items-center justify-start',
               'px-4 py-3 sm:px-6',
               'bg-gray-50',
               'shadow sm:rounded-tl-md sm:rounded-tr-md',
               'cursor-pointer' => $collapsable
            ])
        >
            {{ $header }}
        </div>
    @endif

    <div x-show="show" @class([
        'py-4 py-5 sm:p-6',
        'bg-white',
        'shadow',
        'sm:rounded-bl-md sm:rounded-br-md' => !isset($actions),
        'sm:rounded-tl-md sm:rounded-tr-md' => !isset($header),
    ]) >
        {{$slot}}
    </div>

    @if(isset($actions))
        <div  x-show="!collapsable || show" class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            {{ $actions }}
        </div>
    @endif
</div>

