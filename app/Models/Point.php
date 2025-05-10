<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $table = 'points_of_sales';

    protected $fillable = [
        'name',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'point_of_sale_supplier', 'point_id', 'supplier_id');
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'point_id');
    }
}
