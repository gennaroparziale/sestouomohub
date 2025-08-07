<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Libretto dei Cori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div x-data="{ open: null }">
                        @forelse ($cori as $coro)
                            <div class="border-b dark:border-gray-700">
                                <button @click="open = open === {{ $coro->id }} ? null : {{ $coro->id }}" class="w-full text-left py-4 px-2 focus:outline-none">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-medium">{{ $coro->titolo }}</h3>
                                        <svg class="w-6 h-6 transform transition-transform" :class="{'rotate-180': open === {{ $coro->id }}}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-show="open === {{ $coro->id }}" x-collapse class="pb-4 px-2">
                                    <div class="prose dark:prose-invert max-w-none">
                                        {!! nl2br(e($coro->testo)) !!}
                                    </div>
                                    @if($coro->note)
                                        <div class="mt-4 p-3 bg-gray-100 dark:bg-gray-700 rounded-md text-sm">
                                            <strong>Note:</strong> {{ $coro->note }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p>Il libretto dei cori è ancora vuoto. Torna più tardi!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
