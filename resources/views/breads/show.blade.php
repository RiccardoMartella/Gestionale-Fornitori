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
                    
                    <!-- Filtro per punto vendita -->
                    <div class="mb-8">
                        <form method="GET" action="{{ route('breads.show', $bread->id) }}" class="flex flex-col sm:flex-row gap-4 items-end">
                            <div class="flex-grow">
                                <label for="point_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filtra per punto vendita</label>
                                <select name="point_id" id="point_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                                    <option value="">Tutti i punti vendita</option>
                                    @foreach($allPoints as $pointOption)
                                        <option value="{{ $pointOption->id }}" {{ request('point_id') == $pointOption->id ? 'selected' : '' }}>
                                            {{ $pointOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 h-10">
                                Filtra
                            </button>
                            @if(request('point_id'))
                                <a href="{{ route('breads.show', $bread->id) }}" class="px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 h-10 flex items-center">
                                    Rimuovi filtro
                                </a>
                            @endif
                        </form>
                    </div>

                    @if(isset($point))
                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-800 rounded-lg">
                            <h3 class="font-semibold text-lg text-blue-800 dark:text-blue-200">
                                Dati filtrati per: {{ $point->name }}
                            </h3>
                        </div>
                    @endif

                    <!-- Consegne -->
                    <div class="mt-8 border-t pt-6 border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold mb-4 text-center">Storico consegne</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Punto Vendita</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fornitore</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantità</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($deliveries as $delivery)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ date('d/m/Y', strtotime($delivery->delivery_date)) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                @if($delivery->point)
                                                    {{ $delivery->point->name }}
                                                @else
                                                    N/D
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                @if($delivery->supplier)
                                                    {{ $delivery->supplier->name }}
                                                @else
                                                    N/D
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $delivery->quantity }} {{$delivery->unit}}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('deliveries.edit', $delivery->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Modifica</a>
                                                <form action="{{ route('deliveries.destroy', $delivery->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200" 
                                                        onclick="return confirm('Sei sicuro di voler eliminare questa consegna?')">
                                                        Elimina
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                Nessuna consegna trovata
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4 px-6 py-3">
                                {{ $deliveries->appends(['returns_page' => request('returns_page'), 'point_id' => request('point_id')])->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Resi -->
                    <div class="mt-8 border-t pt-6 border-gray-200 dark:border-gray-700">
                        <h2 class="text-xl font-semibold mb-4 text-center">Storico resi</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Punto Vendita</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fornitore</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantità</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($returns as $return)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ date('d/m/Y', strtotime($return->delivery_date)) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                @if($return->point)
                                                    {{ $return->point->name }}
                                                @else
                                                    N/D
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                @if($return->supplier)
                                                    {{ $return->supplier->name }}
                                                @else
                                                    N/D
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $return->quantity }} {{$return->unit}}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('returns.edit', $return->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Modifica</a>
                                                <form action="{{ route('returns.destroy', $return->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200" 
                                                        onclick="return confirm('Sei sicuro di voler eliminare questo reso?')">
                                                        Elimina
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                Nessun reso trovato
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4 px-6 py-3">
                                {{ $returns->appends(['deliveries_page' => request('deliveries_page'), 'point_id' => request('point_id')])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>