<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointRequest;
use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Delivery;
use App\Models\ReturnDelivery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function store(StorePointRequest $request)
    {
        $validated = $request->validated();
        $point = Point::create($validated);
        
        if (isset($validated['suppliers']) && !empty($validated['suppliers'])) {
            $point->suppliers()->sync($validated['suppliers']);
        }

        return redirect()->route('dashboard.index')
            ->with('success', 'Punto vendita creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Point $point)
    {
        $inventoryData = Inventory::where('point_id', $point->id)
            ->join('breads', 'inventories.bread_id', '=', 'breads.id')
            ->select('breads.name', 'inventories.quantity', 'inventories.unit')
            ->get();

        $year = Carbon::now()->year;
        
        $monthlyDeliveriesKg = Delivery::where('point_id', $point->id)
            ->whereYear('delivery_date', $year)
            ->where('unit', 'kg')
            ->select(DB::raw('MONTH(delivery_date) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        $monthlyReturnsKg = ReturnDelivery::where('point_id', $point->id)
            ->whereYear('delivery_date', $year)
            ->where('unit', 'kg')
            ->select(DB::raw('MONTH(delivery_date) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        $monthlyDeliveriesLitri = Delivery::where('point_id', $point->id)
            ->whereYear('delivery_date', $year)
            ->where('unit', 'litri')
            ->select(DB::raw('MONTH(delivery_date) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        $monthlyReturnsLitri = ReturnDelivery::where('point_id', $point->id)
            ->whereYear('delivery_date', $year)
            ->where('unit', 'litri')
            ->select(DB::raw('MONTH(delivery_date) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        $monthlyDeliveriesPz = Delivery::where('point_id', $point->id)
            ->whereYear('delivery_date', $year)
            ->where('unit', 'pz')
            ->select(DB::raw('MONTH(delivery_date) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        $monthlyReturnsPz = ReturnDelivery::where('point_id', $point->id)
            ->whereYear('delivery_date', $year)
            ->where('unit', 'pz')
            ->select(DB::raw('MONTH(delivery_date) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        $monthlyTotalsKg = [];
        $monthlyTotalsLitri = [];
        $monthlyTotalsPz = [];
        $runningTotalKg = 0;
        $runningTotalLitri = 0;
        $runningTotalPz = 0;
        
        for ($month = 1; $month <= 12; $month++) {
            $deliveryTotal = $monthlyDeliveriesKg[$month] ?? 0;
            $returnTotal = $monthlyReturnsKg[$month] ?? 0;
            $runningTotalKg += $deliveryTotal - $returnTotal;
            $monthlyTotalsKg[$month - 1] = $runningTotalKg;
            
            $deliveryTotalLitri = $monthlyDeliveriesLitri[$month] ?? 0;
            $returnTotalLitri = $monthlyReturnsLitri[$month] ?? 0;
            $runningTotalLitri += $deliveryTotalLitri - $returnTotalLitri;
            $monthlyTotalsLitri[$month - 1] = $runningTotalLitri;
            
            $deliveryTotalPz = $monthlyDeliveriesPz[$month] ?? 0;
            $returnTotalPz = $monthlyReturnsPz[$month] ?? 0;
            $runningTotalPz += $deliveryTotalPz - $returnTotalPz;
            $monthlyTotalsPz[$month - 1] = $runningTotalPz;
        }
        
        $currentMonth = Carbon::now()->month;
        $monthlyTotalsKg = array_slice($monthlyTotalsKg, 0, $currentMonth);
        $monthlyTotalsLitri = array_slice($monthlyTotalsLitri, 0, $currentMonth);
        $monthlyTotalsPz = array_slice($monthlyTotalsPz, 0, $currentMonth);

        return view('points.show', [
            'point' => $point, 
            'inventoryData' => $inventoryData, 
            'monthlyTotalsKg' => $monthlyTotalsKg, 
            'monthlyTotalsLitri' => $monthlyTotalsLitri,
            'monthlyTotalsPz' => $monthlyTotalsPz
        ]);
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
    public function update(StorePointRequest $request, string $id)
    {
        $validated = $request->validated();
        
        $point = Point::findOrFail($id);
        $point->update(['name' => $validated['name']]);
        
        if (isset($validated['suppliers'])) {
            $point->suppliers()->sync($validated['suppliers']);
        }

        return redirect()->route('dashboard.index')
            ->with('success', 'Punto vendita aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $point = Point::findOrFail($id);
        $point->delete();

        return redirect()->route('dashboard.index')
            ->with('success', 'Punto vendita eliminato con successo!');
    }
}
