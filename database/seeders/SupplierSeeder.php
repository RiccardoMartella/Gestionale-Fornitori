<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('suppliers')->insert([
            'name' => 'Forno Rossi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Panificio Bianchi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('suppliers')->insert([
            'name' => 'Forno fff',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Panificio vvv',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('suppliers')->insert([
            'name' => 'Panificio rger',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
