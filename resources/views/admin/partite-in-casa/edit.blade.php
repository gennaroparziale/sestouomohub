<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Modifica Partita in Casa</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.partite-in-casa.update', $partita) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div><x-input-label for="avversario" value="Avversario" /><x-text-input id="avversario" name="avversario" type="text" class="block mt-1 w-full" :value="old('avversario', $partita->avversario)" required /></div>
                            <div><x-input-label for="data_ora_partita" value="Data e Ora" /><x-text-input id="data_ora_partita" name="data_ora_partita" type="datetime-local" class="block mt-1 w-full" :value="old('data_ora_partita', $partita->data_ora_partita->format('Y-m-d\TH:i'))" required /></div>
                            <div class="md:col-span-2"><x-input-label for="stagione" value="Stagione" /><x-text-input id="stagione" name="stagione" type="text" class="block mt-1 w-full" :value="old('stagione', $partita->stagione)" required /></div>
                            <div class="md:col-span-2"><x-input-label for="note" value="Note (Opzionale)" /><textarea id="note" name="note" rows="3" class="block mt-1 w-full ...">{{ old('note', $partita->note) }}</textarea></div>
                        </div>
                        <div class="flex items-center justify-end mt-4"><x-primary-button>Aggiorna Partita</x-primary-button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
