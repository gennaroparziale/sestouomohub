<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista Prenotazioni: {{ $trasferta->avversario }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Riepilogo Trasferta</h3>
                        <p><strong>Data:</strong> {{ $trasferta->data_ora_partita->format('d/m/Y H:i') }}</p>
                        <p><strong>Posti Occupati:</strong> {{ $prenotazioni->count() }} / {{ $trasferta->posti_disponibili }}</p>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cognome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data Prenotazione</th>
                            <th colspan="2" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Azioni</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @forelse ($prenotazioni as $prenotazione)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $prenotazione->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $prenotazione->user->cognome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $prenotazione->user->telefono }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $prenotazione->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($prenotazione->pagato)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pagato</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non Pagato</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(!$prenotazione->pagato)
                                        <form method="POST" action="{{ route('admin.prenotazioni.updateStatus', $prenotazione) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-sm text-green-600 hover:text-green-900">Segna Pagato</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Nessun tifoso si è ancora prenotato per questa trasferta.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
