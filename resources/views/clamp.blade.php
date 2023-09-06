<div {{$attributes->class(['group relative cursor-default'])}}>
        <div class="line-clamp-1 opacity-100 group-hover:opacity-0">
                {{$slot}}
        </div>
        <div class="p-2 bg-white opacity-0 group-hover:opacity-100 absolute top-[calc(-0.5rem-1px)] left-[calc(-0.5rem-1px)] right-[calc(-0.5rem-1px)] z-10 box-content border rounded-md">
                {{$slot}}
        </div>
</div>
