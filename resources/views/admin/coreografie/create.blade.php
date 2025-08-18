<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Progetta Nuova Coreografia
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.coreografie.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nome" value="Nome Coreografia / Evento" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                            </div>

                            <div>
                                <x-input-label for="settore_id" value="Settore" />
                                <select name="settore_id" id="settore_id" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">
                                    @foreach ($settori as $settore)
                                        <option value="{{ $settore->id }}">{{ $settore->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="data_evento" value="Data Evento (Opzionale)" />
                                <x-text-input id="data_evento" class="block mt-1 w-full" type="date" name="data_evento" :value="old('data_evento')" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="descrizione_piano" value="Descrizione del Piano Coreografico" />
                                <textarea id="descrizione_piano" name="descrizione_piano" rows="10" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm" placeholder="Es. Fila 1-5: cartoncini rossi. Fila 6-10: cartoncini gialli...">{{ old('descrizione_piano') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Salva Progetto Coreografia
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
