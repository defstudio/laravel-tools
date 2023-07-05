<div {{$attributes->class('grid grid-cols-1 place-items-stretch')}} x-data="{
            show:{{$collapsed?'false':'true'}},
    }">
    @if(isset($header))
        <div {{$header->attributes->class(['flex items-center justify-start px-4 py-3 sm:px-6 bg-gray-50 shadow sm:rounded-tl-md sm:rounded-tr-md'])}}>
            {{ $header }}
            
            @if($collapsable)
                <svg @click='show=!show' x-bind:class="show ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-auto cursor-pointer transition-transform duration-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"/>
                </svg>
            @endif
        </div>
    @endif
    
    <div x-show="show"
         x-transition:enter="transition-transform transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-3"
            @class([
            'sm:rounded-bl-md sm:rounded-br-md' => !isset($actions),
            'sm:rounded-tl-md sm:rounded-tr-md' => !isset($header),
            'p-4 sm:px-6' => $padding,
            'bg-white',
            'shadow',
        ]) >
        {{$slot}}
    </div>
    
    @if(isset($actions))
        <div x-show="show" class="flex items-center justify-end px-4 sm:px-6 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            {{ $actions }}
        </div>
    @endif
</div>

