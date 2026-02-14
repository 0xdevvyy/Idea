@props(['name', 'title'])

<div 
    x-data="{show: false, name: @js($name)}"
    x-show="show"
    @keydown.escape.window="show = false"
    @close-modal="show = false"
    @open-modal.window="if($event.detail === name) show = true"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs"
    style="display: none"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4 -translate-x-4"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 -translate-y-4 -translate-x-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-{{ $name }}-title"
    :aria-hidden="!show"
    tabindex="-1"
>
    <x-card @click.away="show = false" class="shadow-xl max-w-2xl w-full max-h-[80-dvh] overflow-auto">
        <div id="modal-{{ $name }}-title" class="font-bold text-xl">
            {{$title}}
        </div>
        <div>
            {{ $slot }}
        </div>

    </x-card>
</div>