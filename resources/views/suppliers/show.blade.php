<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fornitori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('suppliers.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla lista dei fornitori
                        </a>
                    </div>
                
                    <h1 class="text-2xl font-bold mb-6 text-center border-b border-gray-200 dark:border-gray-700 pb-4">{{$supplier->name}}</h1>
                    
                    <h2 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-300">Tipi di Pane</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($breads as $item)
                            <a href="{{ route('breads.show', $item->id) }}"
                               class="btn-orange flex items-center justify-center">
                                {{ $item->name }}
                            </a>
                        @endforeach
                        
                        @if(count($breads) == 0)
                            <p class="text-gray-500 dark:text-gray-400 col-span-full text-center py-4 bg-gray-50 dark:bg-gray-700 rounded-md">
                                <svg class="w-6 h-6 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Nessun tipo di pane disponibile per questo fornitore.
                            </p>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
