<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @if (Auth::user() && Auth::user()->is_admin)
                        {{-- MENU PER L'ADMIN --}}
                        <x-nav-link :href="route('admin.tesseramenti.index')" :active="request()->routeIs('admin.tesseramenti.*')">
                            Tesseramenti
                        </x-nav-link>
                        <x-nav-link :href="route('admin.trasferte.index')" :active="request()->routeIs('admin.trasferte.*')">
                            Trasferte
                        </x-nav-link>
                        <x-nav-link :href="route('admin.transazioni.index')" :active="request()->routeIs('admin.transazioni.*')">
                            Finanze
                        </x-nav-link>
                        <x-nav-link :href="route('admin.materiali.index')" :active="request()->routeIs('admin.materiali.*')">
                            Materiale
                        </x-nav-link>
                        <x-nav-link :href="route('admin.annunci.index')" :active="request()->routeIs('admin.annunci.*')">
                            Annunci
                        </x-nav-link>
                        <x-nav-link :href="route('admin.sondaggi.index')" :active="request()->routeIs('admin.sondaggi.*')">
                            Sondaggi
                        </x-nav-link>
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>Impostazioni</div>
                                        <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.tipi-tessera.index')">
                                        Tipi Tessera
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.categorie-spesa.index')">
                                        Categorie Spesa
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <!-- BLOCCO NOTIFICHE -->
                        <div x-data="{
        open: false,
        notificationsCount: {{ $notificationsCount ?? 0 }},
        newNotifications: [],
        markAsRead() {
            if (this.notificationsCount > 0) {
                fetch('{{ route('admin.notifications.markAsRead') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                this.notificationsCount = 0;
            }
        },
        init() {
            // Chiediamo il permesso per le notifiche browser (se non già concesso)
            if (Notification.permission !== 'granted' && Notification.permission !== 'denied') {
                Notification.requestPermission();
            }

            // Ci mettiamo in ascolto sul canale privato degli admin
            window.Echo.private('admins')
                .notification((notification) => {
                    console.log(notification); // Utile per debug

                    // Quando arriva una notifica...
                    this.notificationsCount++;
                    this.newNotifications.unshift(notification);

                    // E mostriamo il pop-up del browser!
                    if (Notification.permission === 'granted') {
                        new Notification('Nuova Notifica Gestionale!', {
                            body: notification.message,
                            icon: '/favicon.ico' // Puoi mettere qui il link al tuo logo
                        });
                    }
                });
        }
    }"
                             x-init="init()"
                             class="hidden sm:flex sm:items-center sm:ms-6"
                        >
                            <x-dropdown align="right" width="64">
                                <x-slot name="trigger">
                                    <button @click="markAsRead()" class="relative inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 rounded-lg focus:outline-none">
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20"><path d="M12.133 10.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V1.4a1.4 1.4 0 0 0-2.8 0v2.064a.955.955 0 0 0 .021.106A5.406 5.406 0 0 0 1.867 8.832v1.8a2.121 2.121 0 0 0 1.519 2.073c.2.064.41.124.625.183v2.364a2.333 2.333 0 1 0 4.667 0v-2.364a6.248 6.248 0 0 0 .625-.183A2.121 2.121 0 0 0 12.133 10.632ZM9.333 16.4a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/></svg>

                                        <div x-show="notificationsCount > 0" class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1 dark:border-gray-900">
                                            <span x-text="notificationsCount"></span>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">Notifiche</div>

                                    <template x-for="notification in newNotifications" :key="notification.id">
                                        <div class="border-t dark:border-gray-600 px-4 py-3 bg-indigo-50 dark:bg-gray-700/50">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-gray-100" x-text="notification.message"></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Adesso</p>
                                        </div>
                                    </template>

                                    @forelse($unreadNotifications as $notification)
                                        <div class="border-t dark:border-gray-600 px-4 py-3">
                                            <p class="text-sm text-gray-700 dark:text-gray-200">{{ $notification->data['message'] }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    @empty
                                        <template x-if="newNotifications.length === 0">
                                            <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">Nessuna nuova notifica.</div>
                                        </template>
                                    @endforelse
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <!-- FINE BLOCCO NOTIFICHE -->
                    @else
                        {{-- MENU PER L'UTENTE NORMALE --}}
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link :href="route('tesseramento.index')" :active="request()->routeIs('tesseramento.*')">
                            Tesseramento
                        </x-nav-link>
                        <x-nav-link :href="route('trasferte.index')" :active="request()->routeIs('trasferte.index')">
                            Trasferte
                        </x-nav-link>
                        <x-nav-link :href="route('materiali.index')" :active="request()->routeIs('materiali.index')">
                            I miei materiali
                        </x-nav-link>
                        <x-nav-link :href="route('sondaggi.index')" :active="request()->routeIs('sondaggi.*')">
                            Sondaggi
                        </x-nav-link>
                        <x-nav-link :href="route('cori.index')" :active="request()->routeIs('cori.index')">
                            Libretto Cori
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profilo') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @if (Auth::user() && Auth::user()->is_admin)
                    {{-- LINK RESPONSIVE PER ADMIN --}}
                    <x-responsive-nav-link :href="route('admin.tesseramenti.index')" :active="request()->routeIs('admin.tesseramenti.*')">
                        Gestione Tesseramenti
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.tipi-tessera.index')" :active="request()->routeIs('admin.tipi-tessera.*')">
                        Gestione Tipi Tessera
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.trasferte.index')" :active="request()->routeIs('admin.trasferte.*')">
                        Gestione Trasferte
                    </x-responsive-nav-link>
                @else
                    {{-- LINK RESPONSIVE PER UTENTE NORMALE --}}
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('tesseramento.index')" :active="request()->routeIs('tesseramento.*')">
                        Tesseramento
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('trasferte.index')" :active="request()->routeIs('trasferte.index')">
                        Trasferte
                    </x-responsive-nav-link>
                @endif
            </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
