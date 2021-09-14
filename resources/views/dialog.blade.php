<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 flex flex-row-reverse">
        {{ $footer }}
    </div>
</x-modal>
