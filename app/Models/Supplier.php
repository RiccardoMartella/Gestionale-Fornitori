<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function bread()
    {
        return $this->hasMany(Bread::class);
    }
    public function pointOfSales()
    {
        return $this->belongsToMany(Point::class, 'point_of_sale_supplier');
    }
}
