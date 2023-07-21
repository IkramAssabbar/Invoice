<?php

namespace App\Imports;

use App\Models\Fournisseur;
use Maatwebsite\Excel\Concerns\ToModel;

class FournisseurImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Fournisseur([
            'nom' => $row[0],
            'adresse' => $row[1],
            'email' => $row[2],
            'cp' => $row[3],
            'ice' => $row[4],
            'pays' => $row[5],
            'ville' => $row[6],
            'tel' => $row[7],
             
        ]);
    }
}
