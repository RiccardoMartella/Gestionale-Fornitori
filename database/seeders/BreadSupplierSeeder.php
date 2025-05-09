<?php

namespace Database\Seeders;

use App\Models\Bread;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class BreadSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ciabatta = Bread::where('name', 'Ciabatta')->first();
        $ciabatta->suppliers()->attach([
            1,
            2 
        ]);
        
        $baguette = Bread::where('name', 'Baguette')->first();
        $baguette->suppliers()->attach([
            2, 
            3 
        ]);
        
        $focaccia = Bread::where('name', 'Focaccia')->first();
        $focaccia->suppliers()->attach([
            3,
            4,
            5  
        ]);
        
        $paneIntegrale = Bread::where('name', 'Pane integrale')->first();
        $paneIntegrale->suppliers()->attach([
            1, 
            5  
        ]);
    }
}
