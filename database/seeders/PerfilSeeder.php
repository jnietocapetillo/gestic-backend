<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
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
                'nombre'=>'Administrador',
                
            ],
            [
                'nombre'=>'Usuario',
            ],
            [
                'nombre'=>'Sin tecnico',
            ],
            [
                'nombre'=>'Tecnico',
            ],
        ];
        $departamento = DB::table('perfil')->insert($data);
    }
}
