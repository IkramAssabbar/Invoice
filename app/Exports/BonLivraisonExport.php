<?php

namespace App\Exports;

use App\Models\BonLivraison;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BonLivraisonExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection,

    */
    public function collection()
    {
        return BonLivraison::select('id','date','adresse','montantTotal','montantHtva','tva','remise')->get();
    }
    public function headings(): array
    {
        return ["id", "date","adresse","montantTotal","montantHtva","tva","remise"];
    }
}
