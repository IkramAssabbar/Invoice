<?php

namespace App\Exports;

use App\Models\FactureReccurente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FactureRecurExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FactureReccurente::select("id", "date", "datereccur","status","montantTotal","montantHtva","tva","remise")->get();
    }
    public function headings(): array
    {
        return ["id", "date","echeance","status","montantTotal","montantHtva","tva","remise"];
    }

}
