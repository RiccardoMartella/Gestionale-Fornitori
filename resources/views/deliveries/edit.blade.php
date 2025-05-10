<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consegne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('dashboard.index', $bread->id) }}" class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-200 transition-all duration-200 border border-gray-300 inline-flex items-center mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla Dashborad
                        </a>
                        
                        <h1 class="text-center text-2xl font-bold mb-6 pb-2 border-b-2 border-orange-400 inline-block">
                            Modifica consegna: {{ $bread->name }}
                        </h1>
                        
                        <form action="{{ route('deliveries.update', $delivery->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="bread_id" value="{{ $bread->id }}">
                            <input type="hidden" name="points_of_sales_id" value="{{ $delivery->points_of_sales_id }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="expected_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantità prevista (Kg)</label>
                                    <input type="number" name="expected_quantity" id="expected_quantity" value="{{ $delivery->expected_quantity }}"
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantità effettiva (Kg)</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ $delivery->quantity }}"
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white" required>
                                </div>
                            </div>

                            <div>
                                <label for="delivery_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data di consegna</label>
                                <input type="date" name="delivery_date" id="delivery_date" value="{{ $delivery->delivery_date }}"
                                    class="w-full md:w-1/2 mx-auto block border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white" required>
                            </div>

                            <div class="pt-4 flex justify-center">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200">
                                    Modifica consegna
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>