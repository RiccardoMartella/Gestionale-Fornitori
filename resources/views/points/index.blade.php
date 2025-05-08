<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Punti Vendita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-center text-2xl font-bold mb-8 border-b border-gray-200 dark:border-gray-700 pb-4">Elenco Punti Vendita</h1>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    <div class="flex flex-wrap gap-3 justify-center">
                        @forelse ($points as $point)

                        <a href="{{ route('points.show', $point->id) }}"
                               class="btn-orange">
                                {{ $point->name }}
                            </a>
                        @empty
                            <p class="text-center text-gray-500 dark:text-gray-400">Nessun punto vendita trovato</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
