<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    /**
     * Get the breads associated with the supplier.
     */
    public function breads()
    {
        return $this->belongsToMany(Bread::class, 'bread_supplier');
    }

    /**
     * Get the points of sale associated with the supplier.
     */
    public function pointOfSales()
    {
        return $this->belongsToMany(Point::class, 'point_of_sale_supplier', 'supplier_id', 'point_id');
    }
}
