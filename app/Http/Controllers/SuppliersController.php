<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuppliersRequest;
use App\Models\Supplier;
use App\Models\Point;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers =  Supplier::all();
        return view('suppliers.index', ["suppliers" => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $points = Point::all();
        return view('suppliers.create', compact('points'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuppliersRequest $request)
    {
        $validated = $request->validated();
        $supplier = Supplier::create($validated);
        
        
        if (isset($validated['points'])) {
            $supplier->pointOfSales()->sync($validated['points']);
        }
        
        return redirect()->route('dashboard.index')->with('success', 'Fornitore/Punto Vendita creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $breads = $supplier->breads; 

        return view('suppliers.show', [
            "supplier" => $supplier,
            "breads" => $breads
        ]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $points = Point::all();
        
        return view('suppliers.edit', (['supplier' => $supplier,'points' => $points]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSuppliersRequest $request, string $id)
    {
        $validated = $request->validated();
        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $validated['name'],
            'address' => $validated['address'] ?? $supplier->address,
            'phone' => $validated['phone'] ?? $supplier->phone,
            'email' => $validated['email'] ?? $supplier->email,
        ]);
   
        if (isset($validated['points'])) {
            $supplier->pointOfSales()->sync($validated['points']);
        }
        
        return redirect()->route('dashboard.index')->with('success', 'Fornitore aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('dashboard.index');
    }
}
