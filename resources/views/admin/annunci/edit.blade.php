<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica Annuncio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.annunci.update', $annuncio) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="titolo" value="Titolo" />
                            <x-text-input id="titolo" class="block mt-1 w-full" type="text" name="titolo" :value="old('titolo', $annuncio->titolo)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="contenuto" value="Contenuto dell'Annuncio" />
                            <textarea id="contenuto" name="contenuto" rows="10" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">{{ old('contenuto', $annuncio->contenuto) }}</textarea>
                        </div>

                        <div class="block mt-4">
                            <label for="in_evidenza" class="inline-flex items-center">
                                <input id="in_evidenza" type="checkbox" class="rounded ... text-indigo-600 ..." name="in_evidenza" value="1" @checked(old('in_evidenza', $annuncio->in_evidenza))>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Metti in evidenza</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Aggiorna Annuncio
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
