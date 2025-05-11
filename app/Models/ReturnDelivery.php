<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnDelivery extends Model
{
    use HasFactory;
    
    protected $table = 'return_deliveries';

    protected $fillable = [
        'user_id',
        'bread_id',
        'supplier_id',
        'point_id',
        'delivery_date',
        'quantity',
        'expected_quantity',
        'unit'
    ];

    public function bread()
    {
        return $this->belongsTo(Bread::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
