<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
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
                'password' => '$2a$12$u2dHW2C5qMxHTHC1oTt6X.0BH3HHCIBGaDfaoF9jQOzbAwDhSB8w.',
                'dni' => '45789145d',
                'idPerfil' => 1,
                'idDepartamento' => 6,
                'nombre' => 'Pablo',
                'apellidos' => 'Gomez Cruz',
                'email' => 'info@aplicacionesnet.es',
                'avatar' => 'usuarioH.jpg',
                'activo' => 1,
                'movil' => 610339660,
                'domicilio' =>'',
                'localidad' =>'',
                'municipio' =>'',
                'codigo_postal' =>21600                
            ],
        ];

        $usuario = DB::table('usuarios')->insert($data);
    }
}
