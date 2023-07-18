<?php

namespace App\Exports;

use App\Models\BonCommande;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BonCommandExport implements FromCollection,WithHeadings

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BonCommande::select('id','date','dateLivraison','montantTotal','montantHtva','tva','remise')->get();
    }
    public function headings(): array
    {
        return ["id","date","dateLivraison","montantTotal","montantHtva","tva","remise"];
    }
}
