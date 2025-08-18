<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Gestione Settori</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success')) <div class="mb-4 p-4 ... bg-green-100 ...">{{ session('success') }}</div> @endif
                    <div class="flex justify-end mb-4"><a href="{{ route('admin.settori.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 ... text-white ... rounded-md ...">Aggiungi Settore</a></div>
                    <table class="min-w-full ...">
                        <thead class="bg-gray-50 ...">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">File</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posti per Fila</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-right">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white ...">
                        @forelse ($settori as $settore)
                            <tr>
                                <td class="px-6 py-3 ...">{{ $settore->nome }}</td>
                                <td class="px-6 py-3 ...">{{ $settore->numero_file }}</td>
                                <td class="px-6 py-3 ...">{{ $settore->posti_per_fila }}</td>
                                <td class="px-6 py-3 ... text-right">
                                    <div class="flex items-center justify-end space-x-4">
                                        <form method="GET" action="{{ route('admin.settori.edit', $settore) }}">
                                            <button class="text-gray-500 hover:text-indigo-600" title="Modifica">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                            </button>
                                        </form>
                                        <x-confirm-modal>
                                            <x-slot name="trigger">
                                                <button class="text-gray-500 hover:text-red-600" title="Elimina">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="title">Conferma Eliminazione</x-slot>
                                            <x-slot name="content">Sei sicuro di voler eliminare il settore <strong>{{ $settore->nome }}</strong>?</x-slot>
                                            <form method="POST" action="{{ route('admin.settori.destroy', $settore) }}"> @csrf @method('DELETE') <x-danger-button type="submit">Sì, Elimina</x-danger-button></form>
                                        </x-confirm-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-4 text-center">Nessun settore definito.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
