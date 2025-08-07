<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aggiungi Nuovo Coro
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.cori.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="titolo" value="Titolo del Coro" />
                            <x-text-input id="titolo" class="block mt-1 w-full" type="text" name="titolo" :value="old('titolo')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="testo" value="Testo del Coro" />
                            <textarea id="testo" name="testo" rows="10" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('testo') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="note" value="Note (es. quando cantarlo)" />
                            <textarea id="note" name="note" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('note') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Aggiungi Coro
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
