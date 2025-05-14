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
                    
                    <div class="mb-10">
                        <h2 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-300">Stato Inventario</h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                                <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-white">Inventario in Chilogrammi</h3>
                                <div class="relative" style="height: 300px;">
                                    <canvas id="kgInventoryChart"></canvas>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                                <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-white">Inventario in Litri</h3>
                                <div class="relative" style="height: 300px;">
                                    <canvas id="litriInventoryChart"></canvas>
                                </div>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6 col-span-1 lg:col-span-2">
                                <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-white">Andamento Inventario</h3>
                                <div class="relative" style="height: 300px;">
                                    <canvas id="inventoryTrendChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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
                    
                    <h2 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-300">Fornitori Associati</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($point->suppliers as $supplier)
                            <a href="{{ route('suppliers.show', ['supplier' => $supplier->id, 'point_id' => $point->id]) }}" 
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
                                        {{ $supplier->breads && $supplier->breads->count() > 0 ? $supplier->breads->count() . ' prodotti ' : 'Nessun tipo di prodotto' }}
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inventoryData = @json($inventoryData ?? []);
            
            const kgProducts = inventoryData.filter(item => item.unit === 'kg');
            const litriProducts = inventoryData.filter(item => item.unit === 'litri');
            
            if (kgProducts.length > 0) {
                const kgCtx = document.getElementById('kgInventoryChart').getContext('2d');
                new Chart(kgCtx, {
                    type: 'bar',
                    data: {
                        labels: kgProducts.map(product => product.name),
                        datasets: [{
                            label: 'Quantità (kg)',
                            data: kgProducts.map(product => product.quantity),
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Chilogrammi'
                                }
                            }
                        }
                    }
                });
            } else {
                document.getElementById('kgInventoryChart').parentNode.innerHTML = 
                    '<div class="flex flex-col items-center justify-center h-full">' +
                        '<svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 005.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />' +
                        '</svg>' +
                        '<p class="text-gray-500 text-center">Nessun prodotto in kg in inventario</p>' +
                    '</div>';
            }
            
            if (litriProducts.length > 0) {
                const litriCtx = document.getElementById('litriInventoryChart').getContext('2d');
                new Chart(litriCtx, {
                    type: 'bar',
                    data: {
                        labels: litriProducts.map(product => product.name),
                        datasets: [{
                            label: 'Quantità (litri)',
                            data: litriProducts.map(product => product.quantity),
                            backgroundColor: [
                                'rgba(255, 159, 64, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(75, 192, 192, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 159, 64, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Litri'
                                }
                            }
                        }
                    }
                });
            } else {
                document.getElementById('litriInventoryChart').parentNode.innerHTML = 
                    '<div class="flex flex-col items-center justify-center h-full">' +
                        '<svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 005.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />' +
                        '</svg>' +
                        '<p class="text-gray-500 text-center">Nessun prodotto in litri in inventario</p>' +
                    '</div>';
            }
            
            const trendCtx = document.getElementById('inventoryTrendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'].slice(0, new Date().getMonth() + 1),
                    datasets: [
                        {
                            label: 'Totale in Kg',
                            data: @json($monthlyTotalsKg ?? array_fill(0, 12, 0)),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Totale in Litri',
                            data: @json($monthlyTotalsLitri ?? array_fill(0, 12, 0)),
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        });
    </script>
</x-app-layout>
