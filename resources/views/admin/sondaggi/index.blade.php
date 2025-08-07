<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gestione Sondaggi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('admin.sondaggi.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 ... text-white ... rounded-md ...">
                            Crea Nuovo Sondaggio
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domanda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stato</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Opzioni</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Voti Totali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Azioni</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @forelse ($sondaggi as $sondaggio)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $sondaggio->domanda }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sondaggio->stato }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sondaggio->opzioni_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sondaggio->voti_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Nessun sondaggio creato.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
