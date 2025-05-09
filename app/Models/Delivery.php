<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_date',
        'bread_id',
        'point_id',
        'expected_quantity',
        'quantity',
        'user_id',
        'supplier_id',
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
