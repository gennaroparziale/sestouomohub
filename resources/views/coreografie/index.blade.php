<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Progetti Coreografie</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse ($coreografie as $coreografia)
                    <a href="{{ route('coreografie.show', $coreografia) }}" class="block p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $coreografia->nome_evento }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Settore: {{ $coreografia->settore->nome }}
                            @if($coreografia->data_evento)
                                - Data: {{ $coreografia->data_evento->format('d/m/Y') }}
                            @endif
                        </p>
                    </a>
                @empty
                    <div class="p-6 bg-white dark:bg-gray-800 ..."><p>Nessuna coreografia in programma.</p></div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
