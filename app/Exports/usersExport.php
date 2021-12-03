<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'ID',
            'DNI',
            'Perfil',
            'Departamento',
            'Nombre',
            'Apellidos',
            'Email',
            'Imagen',
            'Creado',
            'Actualizado',
            'Activo',
            'Apellidos',
            'Telefono',
            'Direccion',
            'Localidad',
            'Provincia',
            'Codigo Postal',

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
   use Exportable;

    public function collection()
    {
        return User::all();
    }
}