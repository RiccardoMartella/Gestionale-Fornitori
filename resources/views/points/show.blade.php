<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dettaglio Punto Vendita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('points.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla lista dei punti vendita
                        </a>
                    </div>
                
                    <h1 class="text-2xl font-bold mb-6 text-center border-b border-gray-200 dark:border-gray-700 pb-4">{{ $point->name }}</h1>
                    
                    <!-- Dettagli Punto Vendita -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 mb-8">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                Informazioni Punto Vendita
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                                Dettagli e fornitori associati
                            </p>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700">
                            <dl>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Nome
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ $point->name }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    
                    {{-- <div class="flex justify-end space-x-3 mb-8">
                        <a href="{{ route('points.edit', $point->id) }}" class="px-4 py-2 bg-amber-500 text-white font-medium rounded-md shadow-sm hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-opacity-50">
                            Modifica
                        </a>
                        <form action="{{ route('points.destroy', $point->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo punto vendita?')">
                                Elimina
                            </button>
                        </form>
                    </div> --}}
                    
                    <h2 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-300">Fornitori Associati</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($point->suppliers as $supplier)
                            <a href="{{ route('suppliers.show', $supplier->id) }}" 
                               class="flex items-center p-4 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-12 w-12 bg-blue-100 dark:bg-blue-700 rounded-full flex items-center justify-center">
                                        <svg class="h-6 w-6 text-blue-500 dark:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $supplier->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        {{ $supplier->bread ? $supplier->bread->count() . ' tipi di pane' : 'Nessun tipo di pane' }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-8 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Nessun fornitore associato a questo punto vendita</p>
                                <a href="{{ route('points.edit', $point->id) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Associa fornitori
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
