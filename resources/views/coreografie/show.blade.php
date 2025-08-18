<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Piano Coreografia: {{ $coreografia->nome_evento }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" x-data="{ piano: {{ json_encode($coreografia->piano ?? (object)[]) }} }">
                    <h3 class="text-lg font-medium mb-2">Settore: {{ $settore->nome }}</h3>
                    <p class="text-sm mb-4">{{ $coreografia->descrizione_piano }}</p>

                    <div class="mt-4 bg-gray-200 dark:bg-gray-900 p-2 rounded-md inline-block select-none">
                        @for ($fila = 1; $fila <= $settore->numero_file; $fila++)
                            <div class="flex">
                                @for ($posto = 1; $posto <= $settore->posti_per_fila; $posto++)
                                    @php $chiave = "f{$fila}_p{$posto}"; @endphp
                                    <div :style="{ backgroundColor: piano['{{ $chiave }}']?.colore || '' }"
                                         class="w-8 h-8 border border-gray-400 dark:border-gray-600 m-px"
                                         title="Fila {{ $fila }}, Posto {{ $posto }}">
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
