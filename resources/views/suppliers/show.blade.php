<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dettaglio Fornitore') }}
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
                
                    <h1 class="text-2xl font-bold mb-6 text-center  border-gray-200 dark:border-gray-700 pb-4">{{$supplier->name}}</h1>
                    
                    <!-- Dettagli Fornitore -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 mb-8">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                Informazioni Fornitore
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                                Dettagli e informazioni di contatto
                            </p>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700">
                            <dl>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Nome completo
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ $supplier->name }}
                                    </dd>
                                </div>
                                <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Indirizzo
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ $supplier->address ?? 'Non specificato' }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Email
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ $supplier->email ?? 'Non specificato' }}
                                    </dd>
                                </div>
                                <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Telefono
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ $supplier->phone ?? 'Non specificato' }}
                                    </dd>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                        Punti Vendita
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        @if($supplier->pointOfSales && $supplier->pointOfSales->count() > 0)
                                            <div class="space-y-2">
                                                @foreach($supplier->pointOfSales as $point)
                                                    <a href="{{ route('points.show', $point->id) }}" class="block font-medium text-gray-800 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400">
                                                        {{ strtoupper($point->name) }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            Nessun punto vendita associato
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-semibold mb-3 text-gray-700 dark:text-gray-300">Tipi di Prodotti</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @if($breads && $breads->count() > 0)
                            @foreach ($breads as $bread)
                                <a href="{{ route('breads.show', $bread->id) }}" 
                                    class="flex items-center p-4 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="h-10 w-10 bg-yellow-100 dark:bg-yellow-700 rounded-full flex items-center justify-center">
                                            <svg class="h-5 w-5 text-yellow-500 dark:text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="font-medium text-gray-800 dark:text-white">{{ $bread->name }}</span>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500 col-span-full text-center py-4">Nessun tipo di pane associato a questo fornitore.</p>
                        @endif
                    </div>
                        
                    <h2 class="text-xl font-semibold mb-3 mt-6 text-gray-700 dark:text-gray-300">Punti Vendita</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                        @forelse ($supplier->pointOfSales as $point)
                            <a href="{{ route('points.show', $point->id) }}" 
                               class="flex items-center p-4 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-10 w-10 bg-orange-100 dark:bg-orange-700 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-orange-500 dark:text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $point->name }}</span>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <p class="text-gray-500 dark:text-gray-400">Nessun punto vendita associato</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Ultime Consegne -->
                    <section class="mb-10">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                            <h2 class="text-xl font-semibold mb-4 md:mb-0">Ultime Consegne</h2>
                            
                            <!-- Filtro per mese migliorato -->
                            <div class="bg-white dark:bg-gray-700 p-3 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                                <form action="{{ route('suppliers.show', $supplier->id) }}" method="GET" class="flex flex-wrap items-center gap-4">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <select name="month" id="month-filter" class="min-w-[120px] rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white text-sm">
                                            <option value="all" {{ $selectedMonth == 'all' ? 'selected' : '' }}>Tutti i mesi</option>
                                            <option value="01" {{ $selectedMonth == '01' ? 'selected' : '' }}>Gennaio</option>
                                            <option value="02" {{ $selectedMonth == '02' ? 'selected' : '' }}>Febbraio</option>
                                            <option value="03" {{ $selectedMonth == '03' ? 'selected' : '' }}>Marzo</option>
                                            <option value="04" {{ $selectedMonth == '04' ? 'selected' : '' }}>Aprile</option>
                                            <option value="05" {{ $selectedMonth == '05' ? 'selected' : '' }}>Maggio</option>
                                            <option value="06" {{ $selectedMonth == '06' ? 'selected' : '' }}>Giugno</option>
                                            <option value="07" {{ $selectedMonth == '07' ? 'selected' : '' }}>Luglio</option>
                                            <option value="08" {{ $selectedMonth == '08' ? 'selected' : '' }}>Agosto</option>
                                            <option value="09" {{ $selectedMonth == '09' ? 'selected' : '' }}>Settembre</option>
                                            <option value="10" {{ $selectedMonth == '10' ? 'selected' : '' }}>Ottobre</option>
                                            <option value="11" {{ $selectedMonth == '11' ? 'selected' : '' }}>Novembre</option>
                                            <option value="12" {{ $selectedMonth == '12' ? 'selected' : '' }}>Dicembre</option>
                                        </select>
                                    </div>

                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <select name="year" id="year-filter" class="min-w-[90px] rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white text-sm">
                                            @for($year = date('Y'); $year >= date('Y')-2; $year--)
                                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        Filtra
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                            @if(isset($recentDeliveries) && count($recentDeliveries) > 0)
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prodotto</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Punto Vendita</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantità</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($recentDeliveries as $delivery)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ date('d/m/Y', strtotime($delivery->delivery_date)) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $delivery->bread->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    @if($delivery->point)
                                                        {{ $delivery->point->name }}
                                                    @else
                                                        N/D
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $delivery->quantity }} {{ $delivery->unit }}</td>
                                          
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Nessuna consegna registrata per questo fornitore.
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Ultimi Resi -->
                    <section class="mb-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Ultimi Resi</h2>
                         
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                @if(isset($recentReturns) && count($recentReturns) > 0)
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prodotto</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Punto Vendita</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantità Restituita</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($recentReturns as $return)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ date('d/m/Y', strtotime($return->delivery_date)) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $return->bread->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                        @if($return->point)
                                                            {{ $return->point->name }}
                                                        @else
                                                            N/D
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $return->quantity }} {{ $return->unit }}</td>
                                                 
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Nessun reso registrato per questo fornitore.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                    
                    <!-- Report Totale -->
                    <section class="mb-10">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-4">Report Totale</h2>
                        </div>
                        
                        <!-- Contenuto della tabella Report -->
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prodotto</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unità</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Consegne</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Resi</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @if(isset($productReports) && count($productReports) > 0)
                                            @foreach($productReports as $breadId => $report)
                                                @if($report['deliveries_kg'] > 0 || $report['returns_kg'] > 0)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $report['name'] }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Kg</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($report['deliveries_kg'], 2) }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($report['returns_kg'], 2) }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($report['deliveries_kg'] - $report['returns_kg'], 2) }}</td>
                                                    </tr>
                                                @endif
                                                
                                                @if($report['deliveries_litri'] > 0 || $report['returns_litri'] > 0)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $report['name'] }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">Litri</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($report['deliveries_litri'], 2) }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($report['returns_litri'], 2) }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($report['deliveries_litri'] - $report['returns_litri'], 2) }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            
                                            <!-- Riga di totale -->
                                            <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">TOTALE (Kg)</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($totalDeliveriesKg, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($totalReturnsKg, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($balanceKg, 2) }}</td>
                                            </tr>
                                            
                                            <tr class="bg-gray-50 dark:bg-gray-700 font-semibold">
                                                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">TOTALE (Litri)</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($totalDeliveriesLitri, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($totalReturnsLitri, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ number_format($balanceLitri, 2) }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                    Nessun dato disponibile per questo periodo.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
