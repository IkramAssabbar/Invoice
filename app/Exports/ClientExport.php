<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Client::select('nom', 'prenom', 'email', 'ice', 'if', 'cp', 'adresse', 'ville', 'tel')->get();
    }
    
    public function headings(): array
    {
        return [
            "Nom","Prénom","Email","ICE","IF", "CP","Adresse","Ville","Téléphone",  
        ];
    }
}