<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crea Nuovo Reso') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="mb-6">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Torna indietro
                    </a>
                </div>

                <h1 class="text-2xl font-bold mb-6 text-center border-b border-gray-200 pb-4 text-white dark:border-gray-700">
                    Nuovo Reso
                </h1>
                
                <form action="{{ route('returns.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')
                    
                    <div class="mb-4">
                        <label for="point_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Punto Vendita</label>
                        <select name="point_id" id="point_of_sale_id" class="form-select" required>
                            <option value="">-- Seleziona punto vendita --</option>
                            @foreach($pointOfSales as $point)
                            <option value="{{ $point->id }}">{{ $point->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(isset($supplier))
                        <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                    @else
                        <div class="mb-4">
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fornitore</label>
                            <select name="supplier_id" id="supplier_id" class="form-select" required>
                                <option value="">-- Seleziona fornitore --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if(isset($bread))
                        <input type="hidden" name="bread_id" value="{{ $bread->id }}">
                    @else
                        <div class="mb-4">
                            <label for="bread_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prodotto</label>
                            <select name="bread_id" id="bread_id" class="form-select" required>
                                <option value="">-- Seleziona prodotto --</option>
                                @foreach($breads as $bread)
                                    <option value="{{ $bread->id }}">{{ $bread->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif



                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unità di misura</label>
                        <select name="unit" id="unit" class="form-select">
                            <option value="kg">kg</option>
                            <option value="litri">litri</option>
                        </select>
                    </div>

                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantità da restituire</label>
                        <input type="number" name="quantity" id="quantity" class="form-input" required>
                    </div>

                    <div>
                        <label for="delivery_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data di reso</label>
                        <input type="date" name="delivery_date" id="delivery_date" value="{{ date('Y-m-d') }}" class="form-input md:w-1/2 mx-auto block" required>
                    </div>

                    <div class="pt-4 flex justify-center">
                        <button type="submit" class="btn-primary">
                            Conferma reso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const breadSelect = document.getElementById('bread_id');
        const pointSelect = document.getElementById('point_of_sale_id');
        const supplierSelect = document.getElementById('supplier_id');

        const originalOptions = {
            bread: breadSelect ? breadSelect.innerHTML : '',
            point: pointSelect ? pointSelect.innerHTML : '',
            supplier: supplierSelect ? supplierSelect.innerHTML : ''
        };

        const toggleLoading = (selects, isLoading = true) => {
            const elements = Array.isArray(selects) ? selects : [selects];
            
            elements.forEach(select => {
                if (!select) return;
                
                select.disabled = isLoading;
                if (isLoading) {
                    select.classList.add('opacity-50');
                } else {
                    select.classList.remove('opacity-50');
                }
            });
        };

        const handleError = (select, original) => {
            if (!select) return;
            select.innerHTML = original;
            toggleLoading(select, false);
            console.error('Errore durante il caricamento dei dati');
        };

        const updateSelect = (select, items, defaultLabel) => {
            if (!select) return;
            
            const currentValue = select.value;
            
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = `-- ${defaultLabel} --`;
            
            select.innerHTML = '';
            select.appendChild(defaultOption);
            
            if (!items || !items.length) {
                toggleLoading(select, false);
                console.warn(`Nessun elemento trovato per ${defaultLabel}`);
                return;
            }
            
            let selectedSet = false;
            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.name;
                
                if (currentValue && item.id.toString() === currentValue.toString()) {
                    option.selected = true;
                    selectedSet = true;
                }
                
                select.appendChild(option);
            });
            
            if (!selectedSet) {
                select.selectedIndex = 0;
            }
            
            toggleLoading(select, false);
        };

        const fetchAndUpdate = async (url, updateConfigs) => {
            try {
                const selectsToUpdate = updateConfigs
                    .map(config => config.select)
                    .filter(select => select);
                
                toggleLoading(selectsToUpdate, true);
                
                const response = await fetch(url);
                
                if (!response.ok) {
                    throw new Error(`Errore HTTP: ${response.status}`);
                }
                
                const data = await response.json();

                
                updateConfigs.forEach(config => {
                    if (config.select && data[config.items]) {
                        updateSelect(config.select, data[config.items], config.label);
                    } else if (config.select) {
                        console.warn(`Dati mancanti per ${config.items}`);
                        handleError(config.select, originalOptions[config.type]);
                    }
                });
            } catch (error) {
                console.error('Errore nel fetch:', error);
                updateConfigs.forEach(config => {
                    if (config.select) {
                        handleError(config.select, originalOptions[config.type]);
                    }
                });
            }
        };
        if (breadSelect) {
            breadSelect.addEventListener('change', function() {
                const breadId = this.value;
                
                if (!breadId) {
                    if (pointSelect) pointSelect.innerHTML = originalOptions.point;
                    if (supplierSelect) supplierSelect.innerHTML = originalOptions.supplier;
                    return;
                }
                
                fetchAndUpdate(`/api/bread/${breadId}/associations`, [
                    { 
                        select: pointSelect, 
                        items: 'points', 
                        label: 'Seleziona punto vendita', 
                        type: 'point' 
                    },
                    { 
                        select: supplierSelect, 
                        items: 'suppliers', 
                        label: 'Seleziona fornitore', 
                        type: 'supplier' 
                    }
                ]);
            });
        }
        if (pointSelect) {
            pointSelect.addEventListener('change', function() {
                const pointId = this.value;
                
                if (!pointId) {
                    if (breadSelect) breadSelect.innerHTML = originalOptions.bread;
                    if (supplierSelect) supplierSelect.innerHTML = originalOptions.supplier;
                    return;
                }
                
                fetchAndUpdate(`/api/point/${pointId}/associations`, [
                    { 
                        select: breadSelect, 
                        items: 'breads', 
                        label: 'Seleziona prodotto', 
                        type: 'bread' 
                    },
                    { 
                        select: supplierSelect, 
                        items: 'suppliers', 
                        label: 'Seleziona fornitore', 
                        type: 'supplier' 
                    }
                ]);
            });
        }
        if (supplierSelect) {
            supplierSelect.addEventListener('change', function() {
                const supplierId = this.value;
                
                if (!supplierId) {
                    if (breadSelect) breadSelect.innerHTML = originalOptions.bread;
                    if (pointSelect) pointSelect.innerHTML = originalOptions.point;
                    return;
                }
                
                fetchAndUpdate(`/api/supplier/${supplierId}/associations`, [
                    { 
                        select: breadSelect, 
                        items: 'breads', 
                        label: 'Seleziona prodotto', 
                        type: 'bread' 
                    },
                    { 
                        select: pointSelect, 
                        items: 'points', 
                        label: 'Seleziona punto vendita', 
                        type: 'point' 
                    }
                ]);
            });
        }
    });
    </script>
    <style>
        
    .form-select {
        width: 100%;
        border: 1px solid rgb(209, 213, 219);
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: rgb(55, 65, 81);
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        appearance: none;
    }

    .dark .form-select {
        background-color: rgb(31, 41, 55);
        border-color: rgb(75, 85, 99);
        color: rgb(209, 213, 219);
    }

    .form-input {
        width: 100%;
        border: 1px solid rgb(209, 213, 219);
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: rgb(55, 65, 81);
    }

    .dark .form-input {
        background-color: rgb(31, 41, 55);
        border-color: rgb(75, 85, 99);
        color: rgb(209, 213, 219);
    }

    .btn-primary {
        padding: 0.5rem 1rem;
        background-color: rgb(37, 99, 235);
        color: white;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: rgb(29, 78, 216);
    }

    .btn-primary:focus {
        outline: none;
        ring: 2px;
        ring-offset: 2px;
        ring-color: rgb(59, 130, 246);
    }
    </style>

</x-app-layout>
