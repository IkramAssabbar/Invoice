<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Service::select('services.Libelle', 'services.Prix', 'services.Tva', 'services.Description', 'categories.Nom_Categorie as NomCategorie')
            ->join('categories', 'services.IdCategorie', '=', 'categories.id')
            ->get();
    }
    
    public function headings(): array
    {
        return ['Libelle','Prix', 'Tva' ,'Description','Categorie'];
    }
}
