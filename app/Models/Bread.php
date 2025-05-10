<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bread extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'bread_supplier');
    }


    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
