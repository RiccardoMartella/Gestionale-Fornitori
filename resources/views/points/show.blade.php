<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $point->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('points.index') }}" class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-200 transition-all duration-200 border border-gray-300 inline-flex items-center mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla lista dei punti vendita
                        </a>
                    </div>

                    <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                Dettagli Punto Vendita
                            </h3>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-600">
                            <dl>
                                <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Nome
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ $point->name }}
                                    </dd>
                                </div>
                                <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Fornitori
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        @if ($point->suppliers && $point->suppliers->count() > 0)
                                            <div class="space-y-1">
                                                @foreach ($point->suppliers as $supplier)
                                                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="text-blue-600 hover:underline block">
                                                        {{ $supplier->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-500">Nessun fornitore associato</span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
