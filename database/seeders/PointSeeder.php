<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('points_of_sales')->insert([
            ['id' => 1, 'name' => 'Punto Rossi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Punto Verdi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Punto Neri', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Punto Gialli', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Punto Bianchi', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('point_of_sale_supplier')->insert([
            ['point_id' => 1, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 2, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 3, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 4, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 5, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 1, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 2, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 2, 'supplier_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['point_id' => 1, 'supplier_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
