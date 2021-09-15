<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        @isset($title)
            <x-slot name="title">
                {{ $title }}
            </x-slot>
        @endisset

        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>

    @isset($footer)
        <div class="px-6 py-4 bg-gray-100 flex flex-row-reverse">
            {{ $footer }}
        </div>
    @endisset
</x-modal>
