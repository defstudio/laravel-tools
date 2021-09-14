<div>
    @if(isset($header))
        <div class="flex items-center justify-start px-4 py-3 bg-gray-50 sm:px-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            {{ $header }}
        </div>
    @endif

    <div @class([
        'py-4',
        'py-5',
        'bg-white',
        'sm:p-6',
        'shadow',
        'sm:rounded-md',
        'sm:rounded-tl-md sm:rounded-tr-md' => isset($actions)
    ])>
        {{$slot}}
    </div>

    @if(isset($actions))
        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            {{ $actions }}
        </div>
    @endif
</div>

