<?php

namespace App\Exports;

use App\Models\Devis;
use App\Models\Facture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DevisExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection,
    */
    public function collection()
    {
        return Devis::select("devis.id", "devis.date", "devis.echeance","devis.status","devis.montantTotal","devis.montantHtva","devis.tva","devis.remise","devis.IdClient as Client" ) 
        ->join('clients', 'devis.IdClient', '=', 'clients.id')
        ->get();

    }
    public function headings(): array
    {
        return ["id", "date","echeance","status","montantTotal","montantHtva","tva","remise","Client"];
    }
}
