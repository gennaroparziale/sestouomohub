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
                                    <span class="font-bold uppercase px-2 py-1 text-xs rounded-full {{ $tesseramento->stato == 'pagato' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ $tesseramento->stato }}
                </span>
                                </p>
                            </div>
                        @else
                            <p>Non risulti ancora tesserato per la stagione corrente.</p>
                            <a href="{{ route('tesseramento.index') }}" class="inline-block mt-2 text-indigo-600 dark:text-indigo-400 hover:underline">
                                Vai alla pagina di tesseramento per iscriverti!
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
