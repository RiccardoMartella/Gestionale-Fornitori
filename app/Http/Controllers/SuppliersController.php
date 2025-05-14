<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuppliersRequest;
use App\Models\Supplier;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use App\Models\Delivery;
use App\Models\ReturnDelivery;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('breads')->get();
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
    public function show(string $id, Request $request)
    {
        $supplier = Supplier::findOrFail($id);
        $breads = $supplier->breads;
        
        $selectedMonth = $request->get('month', date('m'));
        $selectedYear = $request->get('year', date('Y'));
        $pointId = $request->get('point_id');
        
        $point = null;
        if ($pointId) {
            $point = Point::find($pointId);
            if (!$point || !$supplier->pointOfSales->contains($point->id)) {
                $pointId = null;
                $point = null;
            }
        }
        
        $baseDeliveriesQuery = Delivery::where('supplier_id', $id);
        $baseReturnsQuery = ReturnDelivery::where('supplier_id', $id);
        
        if ($pointId) {
            $baseDeliveriesQuery->where('point_id', $pointId);
            $baseReturnsQuery->where('point_id', $pointId);
        }
        
        if ($selectedMonth && $selectedMonth != 'all') {
            $baseDeliveriesQuery->whereMonth('delivery_date', $selectedMonth)
                            ->whereYear('delivery_date', $selectedYear);
            $baseReturnsQuery->whereMonth('delivery_date', $selectedMonth)
                        ->whereYear('delivery_date', $selectedYear);
        }
        
        $recentDeliveries = (clone $baseDeliveriesQuery)->orderBy('delivery_date', 'desc')
                            ->take(10)
                            ->get();
                            
        $recentReturns = (clone $baseReturnsQuery)->orderBy('delivery_date', 'desc')
                         ->take(10)
                         ->get();

        $productReports = [];
        
        $deliveriesByProduct = (clone $baseDeliveriesQuery)
                             ->select('bread_id', 'unit', DB::raw('SUM(quantity) as total_quantity'))
                             ->groupBy('bread_id', 'unit')
                             ->get();
        
        $returnsByProduct = (clone $baseReturnsQuery)
                          ->select('bread_id', 'unit', DB::raw('SUM(quantity) as total_quantity'))
                          ->groupBy('bread_id', 'unit')
                          ->get();
        
        foreach ($deliveriesByProduct as $delivery) {
            if (!isset($productReports[$delivery->bread_id])) {
                $productReports[$delivery->bread_id] = [
                    'name' => $delivery->bread->name,
                    'deliveries_kg' => 0,
                    'returns_kg' => 0,
                    'deliveries_litri' => 0,
                    'returns_litri' => 0,
                ];
            }
            
            if ($delivery->unit == 'kg') {
                $productReports[$delivery->bread_id]['deliveries_kg'] = $delivery->total_quantity;
            } else if ($delivery->unit == 'litri') {
                $productReports[$delivery->bread_id]['deliveries_litri'] = $delivery->total_quantity;
            }
        }
        
        foreach ($returnsByProduct as $return) {
            if (!isset($productReports[$return->bread_id])) {
                $productReports[$return->bread_id] = [
                    'name' => $return->bread->name,
                    'deliveries_kg' => 0,
                    'returns_kg' => 0,
                    'deliveries_litri' => 0,
                    'returns_litri' => 0,
                ];
            }
            
            if ($return->unit == 'kg') {
                $productReports[$return->bread_id]['returns_kg'] = $return->total_quantity;
            } else if ($return->unit == 'litri') {
                $productReports[$return->bread_id]['returns_litri'] = $return->total_quantity;
            }
        }
        
        $totalDeliveriesLitri = (clone $baseDeliveriesQuery)->where('unit', 'litri')->sum('quantity');
        $totalReturnsLitri = (clone $baseReturnsQuery)->where('unit', 'litri')->sum('quantity');
        $totalDeliveriesKg = (clone $baseDeliveriesQuery)->where('unit', 'kg')->sum('quantity');
        $totalReturnsKg = (clone $baseReturnsQuery)->where('unit', 'kg')->sum('quantity');
        $balanceLitri = $totalDeliveriesLitri - $totalReturnsLitri;
        $balanceKg = $totalDeliveriesKg - $totalReturnsKg;

        return view('suppliers.show', [
            "supplier" => $supplier,
            "breads" => $breads,
            "recentDeliveries" => $recentDeliveries,
            "recentReturns" => $recentReturns,
            "totalDeliveriesLitri" => $totalDeliveriesLitri,
            "totalReturnsLitri" => $totalReturnsLitri,
            "balanceLitri" => $balanceLitri,
            "totalDeliveriesKg" => $totalDeliveriesKg,
            "totalReturnsKg" => $totalReturnsKg,
            "balanceKg" => $balanceKg,
            "selectedMonth" => $selectedMonth,
            "selectedYear" => $selectedYear,
            "productReports" => $productReports,
            "pointId" => $pointId,
            "point" => $point
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
