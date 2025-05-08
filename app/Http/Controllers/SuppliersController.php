<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuppliersRequest;
use App\Models\Supplier;


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
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuppliersRequest $request)
    {
        $validated = $request->validated();
        Supplier::create($validated);
        return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        $breads = $supplier->bread; 

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
        $supplier = Supplier::find($id);
        return view('suppliers.edit', ["supplier" => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSuppliersRequest $request, string $id)
    {
        $validated = $request->validated();
        $supplier = Supplier::find($id);
        $supplier->update($validated);
        return redirect()->route('dashboard.index', $supplier->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
