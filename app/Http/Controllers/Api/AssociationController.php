<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bread;
use App\Models\Point;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

class AssociationController extends Controller
{
    /**
     * Get suppliers and points associated with a bread type
     */
    public function breadAssociations($id): JsonResponse
    {
        $bread = Bread::with('suppliers')->findOrFail($id);
        $suppliers = $bread->suppliers->map(fn($s) => ['id' => $s->id, 'name' => $s->name]);
        $points = $bread->suppliers->flatMap->pointOfSales->unique('id')->map(fn($p) => ['id' => $p->id, 'name' => $p->name]);
        return response()->json(['suppliers' => $suppliers, 'points' => $points]);
    }
    
    /**
     * Get breads and points associated with a supplier
     */
    public function supplierAssociations($id): JsonResponse
    {
        $supplier = Supplier::with(['breads', 'pointOfSales'])->findOrFail($id);
        $breads = $supplier->breads->map(fn($b) => ['id' => $b->id, 'name' => $b->name]);
        $points = $supplier->pointOfSales->map(fn($p) => ['id' => $p->id, 'name' => $p->name]);
        return response()->json(['breads' => $breads, 'points' => $points]);
    }
    
    /**
     * Get breads and suppliers associated with a point of sale
     */
    public function pointAssociations($id): JsonResponse
    {
        $point = Point::with('suppliers')->findOrFail($id);
        $suppliers = $point->suppliers->map(fn($s) => ['id' => $s->id, 'name' => $s->name]);
        $breads = $point->suppliers->flatMap->breads->unique('id')->map(fn($b) => ['id' => $b->id, 'name' => $b->name]);
        return response()->json(['suppliers' => $suppliers, 'breads' => $breads]);
    }
}
