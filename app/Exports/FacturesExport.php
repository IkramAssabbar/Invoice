<?php

namespace App\Exports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FacturesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection,
    */
    public function collection()
    {
        return Facture::select("id", "date", "echeance","status","montantTotal","montantHtva","tva","remise","IdClient")->get();

    }
    public function headings(): array
    {
        return ["id", "date","echeance","status","montantTotal","montantHtva","tva","remise","IdClient"];
    }
}
