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
        // Insert breads
        DB::table('breads')->insert([
            ['id' => 1, 'name' => 'Ciabatta', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Baguette', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Focaccia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Pane integrale', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('bread_supplier')->insert([
            ['bread_id' => 1, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['bread_id' => 1, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            
            ['bread_id' => 2, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['bread_id' => 2, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            
            ['bread_id' => 3, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['bread_id' => 3, 'supplier_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['bread_id' => 3, 'supplier_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            
            ['bread_id' => 4, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['bread_id' => 4, 'supplier_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

