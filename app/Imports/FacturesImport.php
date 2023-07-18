<?php

namespace App\Imports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacturesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Facture([
            'id' => $row['id'],
            'date'=> $row['date'],
            'echeance'=> $row['echeance'],
            
            'status'=> $row['status'],
            'montantTotal'=> $row['montantTotal'],
            'montantHtva'=> $row['montantHtva'],
            'tva'=> $row['tva'],
            'remise'=> $row['remise'],
            'IdClient'=> $row['IdClient'],
            
        ]);
       
    }
}
