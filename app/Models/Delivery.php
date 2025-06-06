<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bread_id',
        'point_id',
        'supplier_id',
        'delivery_date',
        'quantity',
        'unit',
        'expected_quantity',
    ];

    public function bread()
    {
        return $this->belongsTo(Bread::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
