<x-dialog :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>

    @isset($title)
        <x-slot name="title">
            {{ $title }}
        </x-slot>
    @endisset

    <div class="mt-4">
        {{ $slot }}
    </div>


    @isset($footer)
        <x-slot name="footer">
            {{ $footer }}
        </x-slot>
    @endisset
</x-dialog>
