<?php

namespace App\Http\Controllers;

use App\Models\ReturnDelivery;
use App\Models\Inventory;
use App\Http\Requests\StoreReturnRequest;
use App\Models\Bread;
use App\Models\Supplier;
use App\Models\Point;
use Illuminate\Support\Facades\Log;

class ReturnDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = ReturnDelivery::with(['bread', 'point'])->get();
        return view('returns.index', ['returns' => $returns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breads = Bread::all();
        $suppliers = Supplier::all(); 
        $pointOfSales = Point::all();
        $bread_id = request('bread_id');
        $point_id = request('point_id');
        $supplier_id = request('supplier_id');

        $bread = $bread_id ? Bread::find($bread_id) : null;
        $point = $point_id ? Point::find($point_id) : null;
        $supplier = $supplier_id ? Supplier::find($supplier_id) : null;

        return view('returns.create', [
            'breads' => $breads,
            'suppliers' => $suppliers,
            'pointOfSales' => $pointOfSales,
            'bread' => $bread,
            'point' => $point,
            'supplier' => $supplier
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReturnRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        if (isset($validated['point_of_sale_id'])) {
            $validated['point_id'] = $validated['point_of_sale_id'];
            unset($validated['point_of_sale_id']);
        }

        $validated['unit'] = $validated['unit'] ?? 'kg';


        $validated['expected_quantity'] = $validated['quantity'];
        $validated['quantity'] = $validated['quantity'];
        
        ReturnDelivery::create($validated);

        $this->updateInventory(
            $validated['bread_id'],
            $validated['point_id'],
            -$validated['quantity'], 
            $validated['unit']
        );

        return redirect()->route('dashboard.index')->with('success', 'Reso registrato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $return = ReturnDelivery::findOrFail($id);
        return view('returns.show', compact('return'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $return = ReturnDelivery::findOrFail($id);
        $bread = Bread::findOrFail($return->bread_id);
        $breads = Bread::all();
        $suppliers = Supplier::all();
        $pointOfSales = Point::all();

        return view('returns.edit', [
            'return' => $return,
            'bread' => $bread,
            'breads' => $breads,
            'suppliers' => $suppliers,
            'pointOfSales' => $pointOfSales,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReturnRequest $request, string $id)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $return = ReturnDelivery::findOrFail($id);

        $oldQuantity = $return->quantity;
        $oldUnit = $return->unit;

        $validated['expected_quantity'] = $validated['quantity'];
        $validated['quantity'] = $validated['quantity']; 

        $return->update($validated);

        $this->updateInventory(
            $return->bread_id,
            $return->point_id,
            $oldQuantity, 
            $oldUnit
        );

        $this->updateInventory(
            $validated['bread_id'],
            $validated['point_id'] ?? $return->point_id,
            -$validated['quantity'], 
            $validated['unit']
        );

        return redirect()->route('dashboard.index')->with('success', 'Reso aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $return = ReturnDelivery::findOrFail($id);

            $this->updateInventory(
                $return->bread_id,
                $return->point_id,
                -$return->quantity,
                $return->unit
            );

            $return->delete();

            Log::info('Reso eliminato con successo', ['return_id' => $id]);

            return redirect()->route('dashboard.index')->with('success', 'Reso eliminato con successo.');
        } catch (\Exception $e) {
            Log::error('Errore eliminazione reso', [
                'return_id' => $id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Errore durante l\'eliminazione del reso: ' . $e->getMessage());
        }
    }

    private function updateInventory($breadId, $pointId, $quantity, $unit)
    {
        if ($pointId) {
            $inventory = Inventory::firstOrNew([
                'bread_id' => $breadId,
                'point_id' => $pointId,
                'unit' => $unit
            ]);

            if (!$inventory->exists) {
                $inventory->quantity = 0;
                $inventory->unit = $unit;
            }

            $inventory->quantity += $quantity;
            $inventory->save();

        }
    }
}
