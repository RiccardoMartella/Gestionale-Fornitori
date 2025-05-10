<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipo di Pane') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('dashboard.index') }}" class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 transition-all duration-200 border border-gray-300">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla dashboard
                        </a>
                    </div>

                    <div class="mb-8 text-center">
                        <h1 class="text-3xl font-bold mb-3 pb-2 border-b-2 border-orange-400 inline-block">
                            {{ $bread->name }}
                        </h1>
                    </div>
                    
                    <!-- Fornitori associati -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Fornitori</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($bread->suppliers as $supplier)
                                <a href="{{ route('suppliers.show', $supplier->id) }}" 
                                   class="flex items-center p-4 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm hover:shadow-lg transition-all duration-200">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="h-10 w-10 bg-blue-100 dark:bg-blue-700 rounded-full flex items-center justify-center">
                                            <svg class="h-5 w-5 text-blue-500 dark:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="font-medium text-gray-800 dark:text-white">{{ $supplier->name }}</span>
                                </a>
                            @empty
                                <div class="col-span-full text-center py-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <p class="text-gray-500 dark:text-gray-400">Nessun fornitore associato</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    
                    {{-- <!-- Pulsante per creare nuova consegna -->
                    <div class="mb-8 text-center">
                        <a href="{{ route('deliveries.create', ['bread_id' => $bread->id]) }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200">
                            Crea nuova consegna
                        </a>
                    </div> --}}

                    <div class="mt-8 border-t pt-6 border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold mb-4 text-center">Storico consegne</h2>
                        @include('deliveries.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>