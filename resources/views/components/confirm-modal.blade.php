@props(['trigger'])

<div x-data="{ open: false }" @keydown.escape.window="open = false" {{ $attributes }}>
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        style="display: none;"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0"
    >
        <div @click="open = false" class="fixed inset-0 bg-gray-900/60 transition-opacity"></div>

        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full max-w-md transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 p-6 text-left shadow-xl transition-all"
        >
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">{{ $title ?? 'Conferma Azione' }}</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $content ?? 'Sei sicuro di voler procedere? Questa azione non può essere annullata.' }}
                </p>
            </div>
            <div class="mt-4 flex justify-end space-x-3">
                <x-secondary-button @click="open = false">Annulla</x-secondary-button>
                {{ $slot }} </div>
        </div>
    </div>
</div>
