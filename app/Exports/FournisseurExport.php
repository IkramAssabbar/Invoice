<?php

namespace App\Exports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\FromCollection;

class FournisseurExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Fournisseur::select('nom', 'adresse', 'email', 'cp', 'ice', 'pays', 'ville', 'tel')->get();
    }
    
    public function headings(): array
    {
        return [
            "Nom","Adresse","Email","CP","ICE", "Pays","Ville","Téléphone",  
        ];
    }
}
