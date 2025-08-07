<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Prossime Trasferte Stagione {{ $stagione }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse($trasferte as $trasferta)
                    @php
                        // Calcoliamo i posti rimasti
                        $postiRimasti = $trasferta->posti_disponibili - $trasferta->prenotazioni_count;
                    @endphp

                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $trasferta->avversario }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Partita: {{ $trasferta->data_ora_partita->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">€ {{ number_format($trasferta->costo, 2, ',', '.') }}</p>
                                <p class="text-sm font-bold {{ $postiRimasti > 5 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $postiRimasti }} posti rimasti
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 border-t dark:border-gray-700 pt-4">
                            <p><strong>Ritrovo:</strong> {{ $trasferta->data_ora_ritrovo->format('d/m/Y H:i') }} @ {{ $trasferta->luogo_ritrovo }}</p>
                            <p><strong>Mezzo:</strong> {{ ucfirst($trasferta->mezzo_trasporto) }}</p>
                        </div>

                        <div class="mt-4 text-right">
                            @if (in_array($trasferta->id, $prenotazioniUtenteIds))
                                <span class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-md">✔ Posto Prenotato</span>
                            @elseif ($postiRimasti <= 0)
                                <span class="px-4 py-2 text-sm font-semibold text-white bg-gray-600 rounded-md">SOLD OUT</span>
                            @else
                                <x-confirm-modal>
                                    <x-slot name="trigger">
                                        <x-primary-button type="button">
                                            Prenota il tuo Posto
                                        </x-primary-button>
                                    </x-slot>

                                    <x-slot name="title">
                                        Conferma Prenotazione
                                    </x-slot>

                                    <x-slot name="content">
                                        Stai per prenotare il tuo posto per la trasferta contro <strong>{{ $trasferta->avversario }}</strong>. <br>
                                        Il costo è di <strong>€ {{ number_format($trasferta->costo, 2, ',', '.') }}</strong>. Vuoi confermare?
                                    </x-slot>

                                    <form method="POST" action="{{ route('trasferte.prenota', $trasferta) }}">
                                        @csrf
                                        <x-primary-button type="submit">
                                            Sì, Conferma Prenotazione
                                        </x-primary-button>
                                    </form>
                                </x-confirm-modal>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="text-gray-900 dark:text-gray-100">Al momento non ci sono trasferte con iscrizioni aperte.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
