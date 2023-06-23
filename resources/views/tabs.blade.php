@php
    $tabs_slots = collect(get_defined_vars())
        ->reject(fn($var, $var_name) => $var_name === 'slot')
        ->filter(fn($var) => $var instanceof \Illuminate\View\ComponentSlot);
@endphp
<div x-data="{active_tab: '{{$active ?? $tabs_slots->keys()->first()}}' }" {{$attributes}}>
    <div class="mb-1 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
            @foreach($tabs_slots as $tab_slot_name => $tab_slot)
                <li class="mr-2" role="presentation">
                    <button class="inline-block px-2 py-1 border-b-2 rounded-t-lg"
                            :class="{
                                    'text-gray-700 border-indigo-400': active_tab == '{{$tab_slot_name}}',
                                    'text-gray-400 border-transparent': active_tab != '{{$tab_slot_name}}',
                                }"
                            @click="active_tab='{{$tab_slot_name}}'"
                            type="button" role="tab">
                        
                        {{$tab_slot->attributes->get('label')}}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    @foreach($tabs_slots as $tab_slot_name => $tab_slot)
        <div x-show="active_tab == '{{$tab_slot_name}}'">
            {{$tab_slot}}
        </div>
    @endforeach
</div>
