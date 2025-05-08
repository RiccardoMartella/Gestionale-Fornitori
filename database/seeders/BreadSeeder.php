<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('breads')->insert([
            'name' => 'Ciabatta',
            'supplier_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('breads')->insert([
            'name' => 'Baguette',
            'supplier_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('breads')->insert([
            'name' => 'Focaccia',
            'supplier_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('breads')->insert([
            'name' => 'Pane integrale',
            'supplier_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

