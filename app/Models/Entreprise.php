<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $fillable =['Nom_Commercial','Pays','Ville','CP',	'ICE','IP','IF','Patente','Telephone'];
    
}
