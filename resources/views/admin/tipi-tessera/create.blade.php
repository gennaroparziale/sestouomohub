<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crea Nuovo Tipo Tessera
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('admin.tipi-tessera.store') }}">
                        @csrf <div>
                            <x-input-label for="nome" value="Nome Tessera (es. Socio Standard)" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="descrizione" value="Descrizione (Opzionale)" />
                            <textarea id="descrizione" name="descrizione" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descrizione') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="prezzo" value="Prezzo (es. 20.00)" />
                            <x-text-input id="prezzo" class="block mt-1 w-full" type="number" step="0.01" name="prezzo" :value="old('prezzo')" required />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="stripe_price_id" value="stripe_price_id_label" />
                            <x-text-input id="stripe_price_id" class="block mt-1 w-full" type="text" name="stripe_price_id" :value="old('stripe_price_id')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="stagione" value="Stagione (es. 2025/2026)" />
                            <x-text-input id="stagione" class="block mt-1 w-full" type="text" name="stagione" :value="old('stagione')" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Salva Tessera
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
