<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sondaggio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">{{ $sondaggio->domanda }}</h3>

                    @if ($votoUtente)
                        {{-- L'UTENTE HA GIÀ VOTATO: MOSTRIAMO I RISULTATI --}}
                        <p class="mb-4 text-green-600 font-semibold">Hai già votato! Ecco i risultati attuali:</p>
                        <div class="space-y-3">
                            @foreach ($sondaggio->opzioni as $opzione)
                                @php
                                    $percentuale = ($sondaggio->voti_count > 0) ? ($opzione->voti / $sondaggio->voti_count) * 100 : 0;
                                @endphp
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-base font-medium dark:text-white {{ $votoUtente->opzione_sondaggio_id == $opzione->id ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
                                            {{ $opzione->testo_opzione }}
                                            @if($votoUtente->opzione_sondaggio_id == $opzione->id)
                                                <span class="text-sm">(Il tuo voto)</span>
                                            @endif
                                        </span>
                                        <span class="text-sm font-medium dark:text-white">{{ $opzione->voti }} Voti ({{ number_format($percentuale, 1) }}%)</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $percentuale }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- L'UTENTE DEVE ANCORA VOTARE: MOSTRIAMO IL FORM --}}
                        <form method="POST" action="{{ route('sondaggi.vota', $sondaggio) }}">
                            @csrf
                            <div class="space-y-4">
                                @foreach ($sondaggio->opzioni as $opzione)
                                    <label for="opzione-{{ $opzione->id }}" class="flex items-center p-4 border rounded-lg dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <input type="radio" id="opzione-{{ $opzione->id }}" name="opzione_sondaggio_id" value="{{ $opzione->id }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                        <span class="ms-3 font-medium text-gray-900 dark:text-gray-100">{{ $opzione->testo_opzione }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <x-primary-button>Invia Voto</x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
