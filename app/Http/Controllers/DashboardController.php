<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\ReturnDelivery;
use App\Models\Bread;
use App\Models\Supplier;
use App\Models\Point;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('pointOfSales')->get();
        $breads = Bread::with('suppliers')->get();
        $deliveries = Delivery::with(['bread', 'bread.suppliers', 'point'])->get();
        $returns = ReturnDelivery::with(['bread', 'supplier', 'point'])->get();
        $points = Point::with('suppliers')->get();
        
        return view('dashboard.index', [
            'suppliers' => $suppliers,
            'breads' => $breads,
            'deliveries' => $deliveries,
            'returns' => $returns,
            'points' => $points,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
