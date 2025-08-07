<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold ...">Modifica Prodotto con Varianti</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.prodotti.update', $prodotto) }}" enctype="multipart/form-data"
                          x-data="{ varianti: {{ $prodotto->varianti->toJson() }} }">
                        @csrf
                        @method('PUT')
                        <h3 class="text-lg font-semibold ...">Dati Prodotto Principale</h3>
                        <div>
                            <x-input-label for="nome" value="Nome Prodotto" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome', $prodotto->nome)" required />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="descrizione" value="Descrizione" />
                            <textarea id="descrizione" name="descrizione" rows="5" class="block mt-1 w-full ...">{{ old('descrizione', $prodotto->descrizione) }}</textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="immagine" value="Immagine Prodotto (lascia vuoto per non modificare)" />
                            <input id="immagine" class="block mt-1 w-full ..." type="file" name="immagine">
                            @if($prodotto->immagine)
                                <div class="mt-2"><img src="{{ Storage::url($prodotto->immagine) }}" alt="{{ $prodotto->nome }}" class="h-20 w-20 object-cover rounded-md"></div>
                            @endif
                        </div>
                        <div class="block mt-4">
                            <label for="is_visibile" class="inline-flex items-center">
                                <input id="is_visibile" type="checkbox" class="rounded ..." name="is_visibile" value="1" @checked(old('is_visibile', $prodotto->is_visibile))>
                                <span class="ms-2 text-sm ...">Rendi visibile nel catalogo</span>
                            </label>
                        </div>

                        <h3 class="text-lg font-semibold ... mt-8 mb-4">Varianti Prodotto</h3>
                        <div class="space-y-4">
                            <template x-for="(variante, index) in varianti" :key="index">
                                <div class="flex items-end space-x-4 p-4 border rounded-md">
                                    <input type="hidden" x-bind:name="'varianti['+index+'][id]'" x-model="variante.id">

                                    <div class="flex-grow">
                                        <x-input-label ::for="'variante_nome_'+index" value="Nome Variante" />
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
                                    <button @click.prevent="varianti.splice(index, 1)" type="button" class="p-2 text-red-500 hover:text-red-700">
                                        <svg class="w-6 h-6" ...><path ...></path></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button @click.prevent="varianti.push({ id: '', nome: '', prezzo: '0.00', quantita_disponibile: 0 })" type="button" class="mt-4 text-sm text-indigo-600 hover:text-indigo-900">
                            + Aggiungi Nuova Variante
                        </button>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>Aggiorna Prodotto</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
