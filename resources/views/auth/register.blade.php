<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
            <!-- CAMPI CUSTOM -->
        <div class="mt-4">
            <x-input-label for="cognome" value="Cognome" />
            <x-text-input id="cognome" class="block mt-1 w-full" type="text" name="cognome" :value="old('cognome')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('cognome')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="sesso" value="Sesso" />
            <select name="sesso" id="sesso" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="" disabled selected>Seleziona un'opzione</option>
                <option value="M" @if(old('sesso') == 'M') selected @endif>Maschio</option>
                <option value="F" @if(old('sesso') == 'F') selected @endif>Femmina</option>
            </select>
            <x-input-error :messages="$errors->get('sesso')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telefono" value="Telefono" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="data_di_nascita" value="Data di Nascita" />
            <x-text-input id="data_di_nascita" class="block mt-1 w-full" type="date" name="data_di_nascita" :value="old('data_di_nascita')" />
            <x-input-error :messages="$errors->get('data_di_nascita')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="luogo_di_nascita" value="Luogo di Nascita" />
            <x-text-input id="luogo_di_nascita" class="block mt-1 w-full" type="text" name="luogo_di_nascita" :value="old('luogo_di_nascita')" />
            <x-input-error :messages="$errors->get('luogo_di_nascita')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="codice_fiscale" value="Codice Fiscale" />
            <x-text-input id="codice_fiscale" class="block mt-1 w-full" type="text" name="codice_fiscale" :value="old('codice_fiscale')" />
            <x-input-error :messages="$errors->get('codice_fiscale')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contatto_emergenza" value="Contatto di Emergenza (es. Nome - 3331234567)" />
            <x-text-input id="contatto_emergenza" class="block mt-1 w-full" type="text" name="contatto_emergenza" :value="old('contatto_emergenza')" />
            <x-input-error :messages="$errors->get('contatto_emergenza')" class="mt-2" />
        </div>
            <!-- FINE CUSTOM -->
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
