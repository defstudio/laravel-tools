<?php
$disabled = $attributes->get('disabled', false);
$required = $attributes->get('required', false);
$attributes = $attributes->except(['disabled', '$required']);
?>

<div {{$attributes}}>
    @if(!empty($label))
        <label for="{{$id}}" class='block font-medium text-sm text-gray-700'>
            {{$label}}
            @if($attributes->has('required') && $attributes->get('required'))
                <span class="text-red-500">&nbsp;*</span>
            @endif
        </label>
    @endif

    <div @class([
        'w-full' => $wFull,
        "grid grid-cols-1 rounded-md shadow-sm",
        "border border-gray-300 focus:border-$color-300",
        "focus:ring focus:ring-$color-200 focus:ring-opacity-50",
    ]) wire:ignore>
    <textarea id="{{$id}}"
              class='{{$base_class(false)}}'
              placeholder="{{$hint}}"
              {{$disabled ? 'disabled' : ''}}
              {{$required ? 'required' : ''}}
    >{!! $slot !!}</textarea>
    </div>
    @if($model && $showErrors)
        @error($model)
        <p class='text-sm text-red-600 mt-2'>{{ $message }}</p>
        @enderror
    @endif
</div>

<script>
    let build_tries = 0;
    const setup = () => {
        setTimeout(() => {
            build_tries++;

            const text_area = document.querySelector('#{{$id}}');

            if (!text_area) {
                if (build_tries > 5) {
                    console.error("Unable to build Trix Editor, element #{{$id}} not found");
                } else {
                    setup();
                }
                return;
            }

            if(typeof ClassicEditor === 'undefined'){
                console.error("CkEditor not found, did you add \<x-scripts\/\> to the end of the main layout file?");
            }

            ClassicEditor
                .create(document.querySelector('#{{$id}}'), {
                    editorClass: 'border-none'
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        console.log(editor.getData());
                        @this.set('{{$model}}', editor.getData(), {{$defer ? 'true' : 'false'}});
                    })
                })
                .catch(error => console.error(error));
        }, 500);
    }


    if (window.livewire) {
        setup();
    } else {
        document.addEventListener('livewire:load', setup);
    }
</script>
