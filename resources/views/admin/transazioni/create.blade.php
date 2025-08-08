<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aggiungi Nuova Transazione
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.transazioni.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="data_transazione" value="Data Transazione" />
                                <x-text-input id="data_transazione" class="block mt-1 w-full" type="date" name="data_transazione" :value="old('data_transazione', now()->format('Y-m-d'))" required />
                            </div>

                            <div>
                                <x-input-label for="tipo" value="Tipo di Movimento" />
                                <select name="tipo" id="tipo" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">
                                    <option value="entrata">Entrata</option>
                                    <option value="uscita">Uscita</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="importo" value="Importo (€)" />
                                <x-text-input id="importo" class="block mt-1 w-full" type="number" step="0.01" name="importo" :value="old('importo')" required />
                            </div>

                            <div>
                                <x-input-label for="categoria_spesa_id" value="Categoria" />
                                <select name="categoria_spesa_id" id="categoria_spesa_id" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">
                                    <option value="">Nessuna Categoria</option>
                                    @foreach ($categorie as $categoria)
                                        <option value="{{ $categoria->id }}" @selected(old('categoria_spesa_id') == $categoria->id)>
                                        {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="descrizione" value="Descrizione" />
                                <x-text-input id="descrizione" class="block mt-1 w-full" type="text" name="descrizione" :value="old('descrizione')" required />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="note" value="Note (Opzionale)" />
                                <textarea id="note" name="note" rows="3" class="block mt-1 w-full ... rounded-md shadow-sm">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Salva Transazione
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
