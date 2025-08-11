<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if ($tesseramento)
                            <h3 class="text-lg font-semibold">Stato Tesseramento Stagione {{ $tesseramento->tipoTessera->stagione }}</h3>
                            <div class="mt-2 p-4 border rounded-lg dark:border-gray-700">
                                <p><strong>Tipo Tessera:</strong> {{ $tesseramento->tipoTessera->nome }}</p>
                                <p><strong>Prezzo:</strong> € {{ number_format($tesseramento->tipoTessera->prezzo, 2, ',', '.') }}</p>
                                <p><strong>Stato Pagamento:</strong>
                                    <span class="font-bold uppercase ... {{ $tesseramento->stato == 'pagato' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                {{ $tesseramento->stato }}
            </span>
                                </p>

                                @if ($tesseramento->stato == 'non pagato')
                                    <div class="mt-4 border-t pt-4 dark:border-gray-700">
                                        <form action="{{ route('checkout.tesseramento', $tesseramento) }}" method="POST">
                                            @csrf
                                            <x-primary-button>Paga con Carta</x-primary-button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-xl font-semibold mb-4 border-b pb-2 dark:border-gray-600">Bacheca Annunci</h3>
                <div class="space-y-6 mt-4">
                    @forelse ($annunci as $annuncio)
                        <div class="p-4 border-l-4 @if($annuncio->in_evidenza) border-yellow-400 bg-yellow-50 dark:bg-gray-700/50 @else border-gray-300 dark:border-gray-700 @endif">
                            <div class="flex justify-between items-center">
                                <h4 class="text-lg font-bold">{{ $annuncio->titolo }}</h4>
                                @if($annuncio->in_evidenza)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">IN EVIDENZA</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                Pubblicato da {{ $annuncio->autore->name ?? 'Admin' }} il {{ $annuncio->created_at->format('d/m/Y') }}
                            </div>
                            <div class="prose dark:prose-invert max-w-none text-sm">
                                {!! nl2br(e($annuncio->contenuto)) !!}
                            </div>
                        </div>
                    @empty
                        <p>Nessun annuncio recente.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
