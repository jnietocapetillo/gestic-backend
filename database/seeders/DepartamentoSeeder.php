<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            [
                'nombre'=>'Administracion',
                
            ],
            [
                'nombre'=>'Contabilidad',
            ],
            [
                'nombre'=>'Financiero',
            ],
            [
                'nombre'=>'Juridico',
            ],
            [
                'nombre'=>'Oficina Tecnica',
            ],
            [
                'nombre'=>'Informatica',
            ],
            [
                'nombre'=>'Direccion',
            ],
        ];
        $departamento = DB::table('departamento')->insert($data);
    }
}
