<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'bread_id',
        'point_id',
        'quantity',
        'unit',
    ];
    
    public function bread()
    {
        return $this->belongsTo(Bread::class);
    }
    
    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function incrementInventory($quantity)
    {
        $this->quantity += $quantity;
        $this->save();
    }
}
