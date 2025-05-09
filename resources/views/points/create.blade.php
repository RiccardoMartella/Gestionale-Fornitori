<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nuovo Punto Vendita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('points.index') }}" class="px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-200 transition-all duration-200 border border-gray-300 inline-flex items-center mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Torna alla lista dei punti vendita
                        </a>
                        
                        <h1 class="text-center text-2xl font-bold mb-6 pb-2 border-b-2 border-orange-400 inline-block">
                            Aggiungi Nuovo Punto Vendita
                        </h1>
                        
                        @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Errore</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <form action="{{route('points.store')}}" method="POST" class="space-y-6">
                            @csrf
                            @method('POST')

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome Punto Vendita</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white @error('name') border-red-500 @enderror" required>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="suppliers" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fornitori</label>
                                    <select name="suppliers[]" id="suppliers" multiple
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white @error('suppliers') border-red-500 @enderror">
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ in_array($supplier->id, old('suppliers', [])) ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Tieni premuto Ctrl (o Cmd) per selezionare più fornitori</p>
                                    @error('suppliers')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            
                            </div>
                            <div class="pt-4 flex justify-center">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200">
                                    Aggiungi Punto Vendita
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>