<?php

namespace App\Exports;

use App\Models\log;
use Maatwebsite\Excel\Concerns\FromCollection;

class logsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return log::all();
    }
}
