<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica Coro
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.cori.update', $coro) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="titolo" value="Titolo del Coro" />
                            <x-text-input id="titolo" class="block mt-1 w-full" type="text" name="titolo" :value="old('titolo', $coro->titolo)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="testo" value="Testo del Coro" />
                            <textarea id="testo" name="testo" rows="10" class="block mt-1 w-full ... rounded-md shadow-sm">{{ old('testo', $coro->testo) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="note" value="Note (es. quando cantarlo)" />
                            <textarea id="note" name="note" rows="3" class="block mt-1 w-full ... rounded-md shadow-sm">{{ old('note', $coro->note) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Aggiorna Coro
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
