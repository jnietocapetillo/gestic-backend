<?php

namespace App\Exports;

use App\Models\incidencia;
use Maatwebsite\Excel\Concerns\FromCollection;

class IncidenciasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return incidencia::all();
    }
}
