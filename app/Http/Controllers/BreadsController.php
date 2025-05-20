<?php

namespace App\Http\Controllers;

use App\Models\Bread;
use App\Models\Supplier;
use App\Http\Requests\StoreBreadsRequest;
use App\Models\Delivery;
use App\Models\Point;
use App\Models\ReturnDelivery;
use Illuminate\Validation\ValidationException;

class BreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breads = Bread::all();

        return view('dashboard.index', ["breads" => $breads]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
          $suppliers = Supplier::all();
        return view('breads.create', ["suppliers" => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBreadsRequest $request)
    {
        $validated = $request->validated();
        
        $bread = Bread::create($validated);
        if (isset($validated['suppliers'])) {
            $bread->suppliers()->sync($validated['suppliers']);
        }

        return redirect()->route('dashboard.index')
            ->with('success', 'Pane creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bread = Bread::with('suppliers')->findOrFail($id);
        $pointId = request('point_id');
        $point = null;
        
        if ($pointId) {
            $point = \App\Models\Point::find($pointId);
        }
        
        $deliveriesQuery = Delivery::where('bread_id', $id)
            ->with(['supplier', 'point']);
        
        $returnsQuery = ReturnDelivery::where('bread_id', $id)
            ->with(['supplier', 'point']);
        
        if ($pointId) {
            $deliveriesQuery->where('point_id', $pointId);
            $returnsQuery->where('point_id', $pointId);
        }
        
        $deliveries = $deliveriesQuery->orderBy('created_at', 'desc')
            ->orderBy('delivery_date', 'desc')
            ->paginate(10, ['*'], 'deliveries_page');
        
        $returns = $returnsQuery->orderBy('created_at', 'desc')
            ->orderBy('delivery_date', 'desc')
            ->paginate(10, ['*'], 'returns_page');
        
        $allPoints = Point::all();

        return view('breads.show', [
            "bread" => $bread, 
            "deliveries" => $deliveries,
            "returns" => $returns,
            "point" => $point,
            "pointId" => $pointId,
            "allPoints" => $allPoints
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bread = Bread::find($id);
        $suppliers = Supplier::all();

        return view('breads.edit', ["bread" => $bread, "suppliers" => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBreadsRequest $request, string $id)
    {
        $validated = $request->validated();
        $bread = Bread::find($id);
        $bread->update($validated);
        
        if (isset($validated['suppliers'])) {
            $bread->suppliers()->sync($validated['suppliers']);
        }

        return redirect()->route('dashboard.index')->with('success', 'Pane aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bread = Bread::find($id);
        $bread->delete();

        return redirect()->route('dashboard.index')
            ->with('success', 'Pane eliminato con successo!');
    }
}
