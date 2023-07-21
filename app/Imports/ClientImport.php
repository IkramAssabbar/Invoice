<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Client([
            'nom' => $row[0],
            'prenom' => $row[1],
            'email' => $row[2],
            'ice' => $row[3],
            'if' => $row[4],
            'cp' => $row[5],
            'adresse' => $row[6],
            'ville' => $row[7],
            'tel' => $row[8],
            'pays' => $row[9],
            
        ]);
    }
}
    
