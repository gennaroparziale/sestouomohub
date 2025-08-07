<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crea Nuovo Sondaggio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.sondaggi.store') }}" x-data="{ opzioni: ['',''] }">
                        @csrf
                        <div>
                            <x-input-label for="domanda" value="Domanda del Sondaggio" />
                            <x-text-input id="domanda" class="block mt-1 w-full" type="text" name="domanda" :value="old('domanda')" required autofocus />
                        </div>

                        <div class="mt-6">
                            <x-input-label value="Opzioni di Risposta" class="mb-2"/>
                            <template x-for="(opzione, index) in opzioni" :key="index">
                                <div class="flex items-center space-x-2 mb-2">
                                    <x-text-input x-model="opzioni[index]" type="text" name="opzioni[]" class="w-full" placeholder="Testo opzione..." required />
                                    <button @click.prevent="opzioni.splice(index, 1)" x-show="opzioni.length > 2" type="button" class="p-2 text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </template>
                            <button @click.prevent="opzioni.push('')" type="button" class="mt-2 text-sm text-indigo-600 hover:text-indigo-900">
                                + Aggiungi Opzione
                            </button>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Crea Sondaggio
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
