<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sondaggi Aperti
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse ($sondaggi as $sondaggio)
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $sondaggio->domanda }}
                        </h3>
                        <div class="mt-4">
                            <a href="{{ route('sondaggi.show', $sondaggio) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                @if (in_array($sondaggio->id, $votiUtenteIds))
                                    Vedi Risultati
                                @else
                                    Vota Ora
                                @endif
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="text-gray-900 dark:text-gray-100">Al momento non ci sono sondaggi aperti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
