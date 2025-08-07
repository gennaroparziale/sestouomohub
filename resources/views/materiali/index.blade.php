<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Materiale a Te Assegnato
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forelse ($materiali as $materiale)
                        <div class="mb-4 p-4 border rounded-lg dark:border-gray-700">
                            <h3 class="text-lg font-bold">{{ $materiale->nome }}</h3>
                            <p class="text-sm"><strong>Tipo:</strong> {{ $materiale->tipo->label() }}</p>
                            <p class="text-sm"><strong>Stato:</strong> {{ ucfirst($materiale->stato) }}</p>
                            @if($materiale->note)
                                <p class="mt-2 text-xs text-gray-600 dark:text-gray-400"><strong>Note:</strong> {{ $materiale->note }}</p>
                            @endif
                        </div>
                    @empty
                        <p>Al momento non hai nessun materiale in custodia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
