<?php

namespace App\Exports;

use App\Models\log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'ID',
            'Tipo Acceso',
            'Usuairo',
            'Fecha',
            'Creado',
            'Actualizado',

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return log::all();
    }
}
