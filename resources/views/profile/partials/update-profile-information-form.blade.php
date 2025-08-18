<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Il tuo profilo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Aggiorna i tuoi dati.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="mt-4">
            <x-input-label for="cognome" :value="__('Cognome')" />
            <x-text-input id="cognome" name="cognome" type="text" class="mt-1 block w-full" :value="old('cognome', $user->cognome)" required autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('cognome')" />
        </div>

        <div class="mt-4">
            <x-input-label for="sesso" :value="__('Sesso')" />
            <select name="sesso" id="sesso" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="M" @selected(old('sesso', $user->sesso) == 'M')>Maschio</option>
                <option value="F" @selected(old('sesso', $user->sesso) == 'F')>Femmina</option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="data_di_nascita" :value="__('Data di Nascita')" />
            <x-text-input id="data_di_nascita" name="data_di_nascita" type="date" class="mt-1 block w-full" :value="old('data_di_nascita', $user->data_di_nascita ? $user->data_di_nascita->format('Y-m-d') : '')" />
        </div>

        <div class="mt-4">
            <x-input-label for="luogo_di_nascita" :value="__('Luogo di Nascita')" />
            <x-text-input id="luogo_di_nascita" name="luogo_di_nascita" type="text" class="mt-1 block w-full" :value="old('luogo_di_nascita', $user->luogo_di_nascita)" />
        </div>

        <div class="mt-4">
            <x-input-label for="codice_fiscale" :value="__('Codice Fiscale')" />
            <x-text-input id="codice_fiscale" name="codice_fiscale" type="text" class="mt-1 block w-full" :value="old('codice_fiscale', $user->codice_fiscale)" />
        </div>

        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->telefono)" />
        </div>

        <div class="mt-4">
            <x-input-label for="contatto_emergenza" :value="__('Contatto di Emergenza')" />
            <x-text-input id="contatto_emergenza" name="contatto_emergenza" type="text" class="mt-1 block w-full" :value="old('contatto_emergenza', $user->contatto_emergenza)" />
        </div>

        <div class="mt-4">
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Non hai ancora verificato la tua email.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Clicca qui per reinviare la mail di verifica.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Ti è stata inviata una nuova mail con il link di verifica.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salva') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Salvato.') }}</p>
            @endif
        </div>
    </form>
</section>
