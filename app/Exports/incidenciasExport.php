<?php

namespace App\Exports;

use App\Models\incidencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncidenciasExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'ID',
            'Id Usuario',
            'Id Tecnico',
            'Fecha',
            'Prioridad',
            'Estado',
            'Titulo',
            'Ubicacion',
            'Descripcion',
            'Imagen',
            'Creado',
            'Actualizado',

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return incidencia::all();
    }
}
