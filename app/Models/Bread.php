<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bread extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier_id',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }
}
