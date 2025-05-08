<form action="{{route('deliveries.store')}}" method="POST" class="space-y-6">
    @csrf
    @method('POST')
    <input type="hidden" name="bread_id" value="{{ $bread->id }}">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="expected_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantità prevista (Kg)</label>
            <input type="number" name="expected_quantity" id="expected_quantity" 
                class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white" required>
        </div>
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantità effettiva (Kg)</label>
            <input type="number" name="quantity" id="quantity" 
                class="w-full border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white" required>
        </div>
    </div>

    <div>
        <label for="delivery_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data di consegna</label>
        <input type="date" name="delivery_date" id="delivery_date" value="{{ date('Y-m-d') }}"
            class="w-full md:w-1/2 mx-auto block border border-gray-300 dark:border-gray-600 rounded-md py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white" required>
    </div>

    <div class="pt-4 flex justify-center">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-200">
            Conferma consegna
        </button>
    </div>
</form>