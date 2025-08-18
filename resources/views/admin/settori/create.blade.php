<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Crea Nuovo Settore</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.settori.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="nome" value="Nome Settore (es. Curva Nord)" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="numero_file" value="Numero di File" />
                            <x-text-input id="numero_file" class="block mt-1 w-full" type="number" name="numero_file" :value="old('numero_file')" required />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="posti_per_fila" value="Posti per Fila" />
                            <x-text-input id="posti_per_fila" class="block mt-1 w-full" type="number" name="posti_per_fila" :value="old('posti_per_fila')" required />
                        </div>
                        <div class="flex items-center justify-end mt-4"><x-primary-button>Salva Settore</x-primary-button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
