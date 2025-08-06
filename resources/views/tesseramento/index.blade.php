<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tesseramento Stagione {{ $stagione }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Scegli la tua tessera:</h3>

                    @forelse($tipiTessera as $tessera)
                        <div class="mb-4 p-4 border rounded-lg dark:border-gray-600 flex justify-between items-center">
                            <div>
                                <h4 class="text-xl font-bold">{{ $tessera->nome }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $tessera->descrizione }}</p>
                                <p class="text-2xl font-semibold mt-2">€ {{ number_format($tessera->prezzo, 2, ',', '.') }}</p>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('tesseramento.store') }}">
                                    @csrf
                                    <input type="hidden" name="tipo_tessera_id" value="{{ $tessera->id }}">
                                    <x-primary-button>
                                        Iscriviti Ora
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>Al momento non ci sono tessere disponibili per la stagione corrente. Riprova più tardi!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
