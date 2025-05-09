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
            'name' => 'Antico Forno Toscano',
            'address' => 'Via della Seta 45, Firenze',
            'phone' => '055 287319',
            'email' => 'info@anticofornotoscano.it',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Panificio Fratelli Bianchi',
            'address' => 'Corso Umberto I 78, Milano',
            'phone' => '02 45679821',
            'email' => 'ordini@panificiobianchi.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('suppliers')->insert([
            'name' => 'Forno Napoletano Esposito',
            'address' => 'Via Toledo 112, Napoli',
            'phone' => '081 3371905',
            'email' => 'fornoesposito@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Panetteria Artigiana Valle',
            'address' => 'Via Roma 23, Trento',
            'phone' => '0461 589426',
            'email' => 'info@panetteriavalletrento.it',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('suppliers')->insert([
            'name' => 'Forno del Porto',
            'address' => 'Lungomare Colombo 87, Genova',
            'phone' => '010 5684321',
            'email' => 'fornodelporto@hotmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
