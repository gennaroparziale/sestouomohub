<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-6">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Tessera Digitale / QR Code
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Mostra questo QR Code all'ingresso per registrare la tua presenza.
                        </p>
                    </header>

                    <div class="mt-6 flex justify-center">
                        <div class="p-4 bg-white inline-block">
                            {!! QrCode::size(250)->generate(Auth::user()->id) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
