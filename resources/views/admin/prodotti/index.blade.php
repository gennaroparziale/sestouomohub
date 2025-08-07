<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gestione Merchandising
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.prodotti.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 ... text-white ... rounded-md ...">
                            Aggiungi Prodotto
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prodotto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prezzo (Varianti)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qtà Totale</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visibile</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Azioni</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @forelse ($prodotti as $prodotto)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($prodotto->immagine)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($prodotto->immagine) }}" alt="{{ $prodotto->nome }}">
                                            @else
                                                <span class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-xs">N/A</span>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $prodotto->nome }}</div>
                                            <div class="text-sm text-gray-500">{{ $prodotto->varianti->count() }} Varianti</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($prodotto->varianti->isNotEmpty())
                                        € {{ $prodotto->varianti->min('prezzo') }} - € {{ $prodotto->varianti->max('prezzo') }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap font-bold">
                                    {{ $prodotto->varianti->sum('quantita_disponibile') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($prodotto->is_visibile)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sì</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-4">
                                        <form method="GET" action="{{ route('admin.prodotti.edit', $prodotto) }}">
                                            <button type="submit" class="text-gray-500 hover:text-indigo-600" title="Modifica">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                            </button>
                                        </form>

                                        <x-confirm-modal>
                                            <x-slot name="trigger">
                                                <button type="button" class="text-gray-500 hover:text-red-600" title="Elimina">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="title">Conferma Eliminazione Prodotto</x-slot>
                                            <x-slot name="content">Sei sicuro di voler eliminare <strong>{{ $prodotto->nome }}</strong> e tutte le sue varianti?</x-slot>
                                            <form method="POST" action="{{ route('admin.prodotti.destroy', $prodotto) }}">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">Sì, Elimina</x-danger-button>
                                            </form>
                                        </x-confirm-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Nessun prodotto nel catalogo.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
