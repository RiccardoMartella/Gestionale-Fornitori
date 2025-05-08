<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'bread_id',
        'user_id',
        'quantity',
        'expected_quantity',
        'delivery_date',
    ];

    public function bread(){  

        return $this->belongsTo(Bread::class);

    }

    public function supplier(){

        return $this->belongsTo(Supplier::class);
        
    }

    
}
