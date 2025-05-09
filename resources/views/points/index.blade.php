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
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold border-b border-gray-200 dark:border-gray-700 pb-2">Elenco Punti Vendita</h1>
                        <a href="{{ route('points.create') }}" class="px-4 py-2 bg-green-600 text-white font-medium rounded-md shadow-sm hover:bg-green-700 transition-all duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nuovo Punto Vendita
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse ($points as $point)
                            <a href="{{ route('points.show', $point->id) }}" 
                               class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 overflow-hidden">
                                <div class="p-5">
                                    <div class="flex items-center justify-center h-16 w-16 bg-orange-100 dark:bg-orange-700 rounded-full mx-auto mb-4">
                                        <svg class="h-8 w-8 text-orange-500 dark:text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-center text-gray-800 dark:text-white mb-2">{{ $point->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-300 text-center">
                                        {{ $point->suppliers->count() }} fornitore/i associato/i
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-8 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Nessun punto vendita trovato</p>
                                <a href="{{ route('points.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Crea il tuo primo punto vendita
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
