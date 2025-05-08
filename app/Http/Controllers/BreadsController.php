<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bread;
use App\Http\Requests\StoreBreadsRequest;
use Illuminate\Validation\ValidationException;

class BreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breads = Bread::all();

        return view('breads.index', ["breads" => $breads]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        return view('breads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBreadsRequest $request)
    {
        try {
            $validated = $request->validated();
            $bread = Bread::create($validated);

            return redirect()->route('dashboard.index', $bread->id);
        } catch (ValidationException $e) {
            if ($e->validator->errors()->has('supplier_id')) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['supplier_id' => 'Il fornitore specificato non esiste.']);
            }
            
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bread = Bread::find($id);
        $deliveries = $bread->deliveries;

        return view('breads.show', ["bread" => $bread, "deliveries" => $deliveries]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bread = Bread::find($id);

        return view('breads.edit', ["bread" => $bread]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBreadsRequest $request, string $id)
    {
        $validated = $request->validated();
        $bread = Bread::find($id);
        $bread->update($validated);

        return redirect()->route('dashboard.index', $bread->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
