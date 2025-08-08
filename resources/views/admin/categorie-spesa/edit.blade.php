<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica Categoria
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.categorie-spesa.update', $categoria) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="nome" value="Nome Categoria" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $categoria->nome)" required autofocus />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>Aggiorna Categoria</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
