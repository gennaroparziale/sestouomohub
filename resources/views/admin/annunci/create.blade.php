<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Scrivi Nuovo Annuncio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.annunci.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="titolo" value="Titolo" />
                            <x-text-input id="titolo" class="block mt-1 w-full" type="text" name="titolo" :value="old('titolo')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="contenuto" value="Contenuto dell'Annuncio" />
                            <textarea id="contenuto" name="contenuto" rows="10" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('contenuto') }}</textarea>
                        </div>

                        <div class="block mt-4">
                            <label for="in_evidenza" class="inline-flex items-center">
                                <input id="in_evidenza" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="in_evidenza" value="1">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Metti in evidenza (pinnato in cima)</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Pubblica Annuncio
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
