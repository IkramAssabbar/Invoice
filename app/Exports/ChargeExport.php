<?php

namespace App\Exports;

use App\Models\Charge;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class chargeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection,

    */
    public function collection()
    {
        return Charge::select('charges.Libelle', 'charges.Prix', 'charges.Tva', 'charges.Description', 'categoriesch.nomCategorie as NomCategorie')
        ->join('categoriesch', 'charges.categorieid', '=', 'categoriesch.id')
        ->get();    }
    public function headings(): array
    {
       return ['Libelle','Prix', 'Tva' ,'Description','Categorie'];
    }
}
