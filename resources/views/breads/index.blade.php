{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipo di Pane') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Catalogo Pane</h1>
                        <a href="{{ route('breads.create') }}" class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition-all duration-200">
                            <span>+ Nuovo Tipo di Pane</span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @if(isset($breads) && is_countable($breads) && count($breads) > 0)
                            @foreach ($breads as $item)
                                <a href="{{ route('breads.show', $item->id) }}"
                                   class="btn-orange flex items-center justify-center py-4 hover:shadow-lg">
                                    {{ $item->name }}
                                </a>
                            @endforeach 
                        @else
                            <div class="col-span-full bg-gray-50 dark:bg-gray-700 rounded-md p-8 text-center">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="text-xl text-gray-500 dark:text-gray-400">Nessun tipo di pane disponibile</p>
                                <p class="mt-2 text-gray-500 dark:text-gray-400">Clicca su "+ Nuovo Tipo di Pane" per iniziare</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
