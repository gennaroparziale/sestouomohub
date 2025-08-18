<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Designer Coreografia: {{ $coreografia->nome_evento }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100"
                     x-data="{
        piano: {{ json_encode($coreografia->piano ?? (object)[]) }},
        colori: ['#EF4444', '#F97316', '#EAB308', '#22C55E', '#3B82F6', '#FFFFFF', '#000000', 'transparent'],
        strumentoSelezionato: '#EF4444',
        coloraPosto(fila, posto) {
            const chiave = `f${fila}_p${posto}`;
            // Creiamo una COPIA per forzare la reattività
            let nuovoPiano = { ...this.piano };

            if (this.strumentoSelezionato === 'transparent' || nuovoPiano[chiave]?.colore === this.strumentoSelezionato) {
                delete nuovoPiano[chiave];
            } else {
                nuovoPiano[chiave] = { colore: this.strumentoSelezionato };
            }

            this.piano = nuovoPiano;
        }
     }">

                    @if(session('success'))
                    @endif

                    <form method="POST" action="{{ route('admin.coreografie.salvaPiano', $coreografia) }}">
                        @csrf
                        <input type="hidden" name="piano" :value="JSON.stringify(piano)">

                        <h3 class="text-lg font-medium">Settore: {{ $settore->nome }} ({{ $settore->numero_file }} File x {{ $settore->posti_per_fila }} Posti)</h3>

                        <div class="my-4 p-2 bg-gray-100 dark:bg-gray-900 rounded-md flex items-center space-x-2 flex-wrap">
                            <span class="text-sm font-medium mr-2">Tavolozza:</span>
                            <template x-for="colore in colori" :key="colore">
                                <button
                                    type="button"
                                    @click="strumentoSelezionato = colore"
                                    :style="{ backgroundColor: colore === 'transparent' ? '#fff' : colore }"
                                    class="w-8 h-8 rounded-full border-2"
                                    :class="strumentoSelezionato === colore ? 'border-indigo-500' : 'border-white dark:border-gray-800'">
                                    <span x-show="colore === 'transparent'" class="text-red-500 font-bold text-xl">X</span>
                                </button>
                            </template>
                            <div class="flex-grow text-right">
                                <x-primary-button type="submit">Salva Piano</x-primary-button>
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-200 dark:bg-gray-900 p-2 rounded-md inline-block select-none">
                            @for ($fila = 1; $fila <= $settore->numero_file; $fila++)
                                <div class="flex">
                                    @for ($posto = 1; $posto <= $settore->posti_per_fila; $posto++)
                                        @php $chiave = "f{$fila}_p{$posto}"; @endphp
                                        <div @click="coloraPosto({{ $fila }}, {{ $posto }})"
                                             :style="{ backgroundColor: piano['{{ $chiave }}']?.colore || '' }"
                                             class="w-8 h-8 border border-gray-400 dark:border-gray-600 m-px flex items-center justify-center text-xs text-gray-500 cursor-pointer hover:opacity-75">
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
