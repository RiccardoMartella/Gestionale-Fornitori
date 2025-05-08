<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Supplier;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $points = Point::all();
        return view('points.index', ["points" => $points]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('points.create', ['suppliers' => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        Point::create($validated);

        return redirect()->route('points.index')
            ->with('success', 'Punto vendita creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $point = Point::with('suppliers')->findOrFail($id);
        return view('points.show', ['point' => $point]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $point = Point::findOrFail($id);
        $suppliers = Supplier::all();
        return view('points.edit', ['point' => $point, 'suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $point = Point::findOrFail($id);
        $point->update($validated);

        return redirect()->route('points.index')
            ->with('success', 'Punto vendita aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $point = Point::findOrFail($id);
        $point->delete();

        return redirect()->route('points.index')
            ->with('success', 'Punto vendita eliminato con successo!');
    }
}
