<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveriesRequest;
use App\Models\Delivery;
use App\Models\Bread;
use App\Models\Supplier;
use App\Models\Point;
use Illuminate\Support\Facades\Log;

class DeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breads = Bread::all();
        $suppliers = Supplier::all();
        $pointOfSales = Point::all();

        $bread_id = request('bread_id');
        $supplier_id = request('supplier_id');

        $bread = $bread_id ? Bread::find($bread_id) : null;
        $supplier = $supplier_id ? Supplier::find($supplier_id) : null;

        return view('deliveries.create', [
            'breads' => $breads,
            'suppliers' => $suppliers,
            'pointOfSales' => $pointOfSales,
            'bread' => $bread,
            'supplier' => $supplier
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveriesRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $delivery = Delivery::create($validated);

        if (!empty($request->supplier_id)) {
            return redirect()->route('dashboard.index', $request->supplier_id)
                ->with('success', 'Consegna registrata con successo.');
        }

        $bread = Bread::find($request->bread_id);
        return redirect()->route('breads.show', $bread->id)
            ->with('success', 'Consegna registrata con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $bread = Bread::findOrFail($delivery->bread_id);
        $breads = Bread::all();
        $suppliers = Supplier::all();
        $pointOfSales = Point::all();

        return view('deliveries.edit', [
            'delivery' => $delivery,
            'bread' => $bread,
            'breads' => $breads,
            'suppliers' => $suppliers,
            'pointOfSales' => $pointOfSales,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDeliveriesRequest $request, string $id)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $delivery = Delivery::findOrFail($id);
        $delivery->update($validated);
        $bread = Bread::findOrFail($delivery->bread_id);
        return redirect()->route('dashboard.index', $bread->id)->with('success', 'Consegna aggiornata con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $delivery = Delivery::findOrFail($id);
            $breadId = $delivery->bread_id;
            $delivery->delete();

            Log::info('Consegna eliminata con successo', ['delivery_id' => $id, 'bread_id' => $breadId]);

            return redirect()->route('breads.show', $breadId)->with('success', 'Consegna eliminata con successo.');
        } catch (\Exception $e) {
            Log::error('Errore eliminazione consegna', [
                'delivery_id' => $id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Errore durante l\'eliminazione della consegna: ' . $e->getMessage());
        }
    }
}
