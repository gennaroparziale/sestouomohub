<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gestione Tesseramenti
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tifoso</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tessera</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stato</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Azioni</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @forelse ($tesseramenti as $tesseramento)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $tesseramento->user->name }} {{ $tesseramento->user->cognome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $tesseramento->tipoTessera->nome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-bold uppercase px-2 py-1 text-xs rounded-full {{ $tesseramento->stato == 'pagato' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ $tesseramento->stato }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if ($tesseramento->stato != 'pagato')
                                        <form method="POST" action="{{ route('admin.tesseramenti.update', $tesseramento) }}" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="stato" value="pagato">
                                            <button type="submit" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-200">
                                                Segna come Pagato
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">Già Pagato</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center">Nessun tesseramento trovato.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
