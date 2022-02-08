<div class="p-2">
    <div wire:click="$emit('closeModal')" class="absolute top-0 right-0 w-6 h-6 rounded-bl-lg border shadow bg-gray-100 flex justify-center items-center cursor-pointer">
        <x-icon size="4" name="x"/>
    </div>

    @unless(empty($title))
        <div class="text-lg underline mb-4">{{$title}}</div>
    @endunless

    <div @class(["md:grid md:grid-cols-$grid md:gap-6" => $grid])>
    {{$slot}}
    </div>

    <div class="mt-6 flex">
        <x-button class="ml-auto" wire:click="save" wire:loading.disable="all">Save</x-button>
    </div>
</div>
