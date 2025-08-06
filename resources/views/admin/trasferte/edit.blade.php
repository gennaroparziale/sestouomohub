<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica Trasferta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.trasferte.update', $trasferta) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="avversario" value="Avversario" />
                                <x-text-input id="avversario" class="block mt-1 w-full" type="text" name="avversario" :value="old('avversario', $trasferta->avversario)" required />
                            </div>
                            <div>
                                <x-input-label for="luogo_partita" value="Luogo Partita" />
                                <x-text-input id="luogo_partita" class="block mt-1 w-full" type="text" name="luogo_partita" :value="old('luogo_partita', $trasferta->luogo_partita)" required />
                            </div>
                            <div>
                                <x-input-label for="data_ora_partita" value="Data e Ora Partita" />
                                <x-text-input id="data_ora_partita" class="block mt-1 w-full" type="datetime-local" name="data_ora_partita" :value="old('data_ora_partita', $trasferta->data_ora_partita->format('Y-m-d\TH:i'))" required />
                            </div>
                            <div>
                                <x-input-label for="data_ora_ritrovo" value="Data e Ora Ritrovo" />
                                <x-text-input id="data_ora_ritrovo" class="block mt-1 w-full" type="datetime-local" name="data_ora_ritrovo" :value="old('data_ora_ritrovo', $trasferta->data_ora_ritrovo->format('Y-m-d\TH:i'))" required />
                            </div>
                            <div>
                                <x-input-label for="luogo_ritrovo" value="Luogo Ritrovo" />
                                <x-text-input id="luogo_ritrovo" class="block mt-1 w-full" type="text" name="luogo_ritrovo" :value="old('luogo_ritrovo', $trasferta->luogo_ritrovo)" required />
                            </div>
                            <div>
                                <x-input-label for="mezzo_trasporto" value="Mezzo di Trasporto" />
                                <select name="mezzo_trasporto" id="mezzo_trasporto" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">
                                    <option value="pullman" @selected(old('mezzo_trasporto', $trasferta->mezzo_trasporto) == 'pullman')>Pullman</option>
                                    <option value="van" @selected(old('mezzo_trasporto', $trasferta->mezzo_trasporto) == 'van')>Van</option>
                                    <option value="auto" @selected(old('mezzo_trasporto', $trasferta->mezzo_trasporto) == 'auto')>Auto</option>
                                    <option value="aereo" @selected(old('mezzo_trasporto', $trasferta->mezzo_trasporto) == 'aereo')>Aereo</option>
                                    <option value="traghetto" @selected(old('mezzo_trasporto', $trasferta->mezzo_trasporto) == 'traghetto')>Traghetto</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="costo" value="Costo (€)" />
                                <x-text-input id="costo" class="block mt-1 w-full" type="number" step="0.01" name="costo" :value="old('costo', $trasferta->costo)" required />
                            </div>
                            <div>
                                <x-input-label for="posti_disponibili" value="Posti Disponibili" />
                                <x-text-input id="posti_disponibili" class="block mt-1 w-full" type="number" step="1" name="posti_disponibili" :value="old('posti_disponibili', $trasferta->posti_disponibili)" required />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="note_logistiche" value="Note Logistiche (Opzionale)" />
                                <textarea id="note_logistiche" name="note_logistiche" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">{{ old('note_logistiche', $trasferta->note_logistiche) }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Aggiorna Trasferta
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
