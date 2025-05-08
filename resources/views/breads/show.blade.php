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
                        <a href="{{ route('suppliers.index') }}" class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 transition-all duration-200 border border-gray-300">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla lista dei fornitori
                        </a>
                    </div>

                    <div class="mb-6">
                        <span class="inline-block bg-blue-50 text-blue-800 font-semibold px-3 py-1.5 rounded-md border-l-4 border-blue-500">
                            Fornitore: {{ $bread->supplier->name }}
                        </span>
                    </div>

                    
                    <div class="mb-6">
                        <h1 class="text-center text-2xl font-bold mb-6 pb-2 border-b-2 border-orange-400 inline-block">
                            {{ $bread->name }}
                        </h1>
                        @include('deliveries.create')
                    </div>
                    <div class="mt-8 border-t pt-6 border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold mb-4 text-center">Storico consegne</h2>
                        @include('deliveries.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>