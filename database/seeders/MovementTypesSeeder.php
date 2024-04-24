<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\DB;

class MovementTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movement_types')->insert([
            [
                'code' => 'E',
                'flow' => 'E',
                'name' => 'Entrada Ajuste',
                'description' => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'code' => 'S',
                'flow' => 'S',
                'name' => 'Salida Ajuste',
                'description' => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'code' => 'V',
                'flow' => 'S',
                'name' => 'Venta',
                'description' => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'code' => 'DC',
                'flow' => 'S',
                'name' => 'Devolucion Cliente',
                'description' => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'code' => 'EIT',
                'flow' => 'E',
                'name' => 'Entrada Inventario Tienda',
                'description' => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'code' => 'EIC',
                'flow' => 'E',
                'name' => 'Entrada Inventario Compra',
                'description' => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
    }
}
