<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Aggiungi Nuovo Prodotto con Varianti</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.prodotti.store') }}" enctype="multipart/form-data" x-data="{ varianti: [{ nome: '', prezzo: '0.00', quantita_disponibile: 0 }] }">
                        @csrf
                        <h3 class="text-lg font-semibold border-b pb-2 mb-4">Dati Prodotto Principale</h3>
                        <div>
                            <x-input-label for="nome" value="Nome Prodotto (es. Maglietta Logo)" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="descrizione" value="Descrizione" />
                            <textarea id="descrizione" name="descrizione" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('descrizione') }}</textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="immagine" value="Immagine Principale" />
                            <input id="immagine" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="immagine">
                        </div>
                        <div class="block mt-4">
                            <label for="is_visibile" class="inline-flex items-center">
                                <input id="is_visibile" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="is_visibile" value="1" checked>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Rendi visibile nel catalogo</span>
                            </label>
                        </div>

                        <h3 class="text-lg font-semibold border-b pb-2 mt-8 mb-4">Varianti Prodotto (Taglie, Colori, etc.)</h3>
                        <div class="space-y-4">
                            <template x-for="(variante, index) in varianti" :key="index">
                                <div class="flex items-end space-x-4 p-4 border rounded-md dark:border-gray-700">
                                    <div class="flex-grow">
                                        <x-input-label ::for="'variante_nome_'+index" value="Nome Variante (es. Taglia S - Nera)" />
                                        <x-text-input ::id="'variante_nome_'+index" class="block mt-1 w-full" type="text" x-bind:name="'varianti['+index+'][nome]'" x-model="variante.nome" required />
                                    </div>
                                    <div>
                                        <x-input-label ::for="'variante_prezzo_'+index" value="Prezzo (€)" />
                                        <x-text-input ::id="'variante_prezzo_'+index" class="block mt-1 w-full" type="number" step="0.01" x-bind:name="'varianti['+index+'][prezzo]'" x-model="variante.prezzo" required />
                                    </div>
                                    <div>
                                        <x-input-label ::for="'variante_qta_'+index" value="Quantità" />
                                        <x-text-input ::id="'variante_qta_'+index" class="block mt-1 w-full" type="number" step="1" x-bind:name="'varianti['+index+'][quantita_disponibile]'" x-model="variante.quantita_disponibile" required />
                                    </div>
                                    <button @click.prevent="varianti.splice(index, 1)" x-show="varianti.length > 1" type="button" class="p-2 text-red-500 hover:text-red-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button @click.prevent="varianti.push({ nome: '', prezzo: '0.00', quantita_disponibile: 0 })" type="button" class="mt-4 text-sm text-indigo-600 hover:text-indigo-900">
                            + Aggiungi Variante
                        </button>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>Salva Prodotto</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
