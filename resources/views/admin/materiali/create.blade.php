<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aggiungi Nuovo Materiale
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.materiali.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="nome" value="Nome Materiale" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
                            </div>

                            <div>
                                <x-input-label for="tipo" value="Tipo" />
                                <select name="tipo" id="tipo" class="block mt-1 w-full ...">
                                    @foreach (App\Enums\MaterialeTipoEnum::cases() as $tipo)
                                        <option value="{{ $tipo->value }}" @selected(old('tipo') == $tipo->value)>
                                        {{ $tipo->label() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="quantita" value="Quantità" />
                                <x-text-input id="quantita" class="block mt-1 w-full" type="number" name="quantita" value="1" required />
                            </div>

                            <div>
                                <x-input-label for="stato" value="Stato" />
                                <select name="stato" id="stato" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">
                                    <option value="disponibile">Disponibile</option>
                                    <option value="in sede">In Sede</option>
                                    <option value="in trasferta">In Trasferta</option>
                                    <option value="in riparazione">In Riparazione</option>
                                    <option value="ritirato">Ritirato</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="responsabile_id" value="Responsabile (Opzionale)" />
                                <select name="responsabile_id" id="responsabile_id" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">
                                    <option value="">Nessuno</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->cognome }} {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="descrizione" value="Descrizione (Opzionale)" />
                                <textarea id="descrizione" name="descrizione" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">{{ old('descrizione') }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="note" value="Note (Opzionale)" />
                                <textarea id="note" name="note" class="block mt-1 w-full border-gray-300 ... rounded-md shadow-sm">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Salva Materiale
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
