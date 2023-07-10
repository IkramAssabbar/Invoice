<?php

namespace App\Models;
use App\Models\Facture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable=['Libelle','Prix', 'Tva' ,'Description','IdCategorie']	;	
   
    public function Factures()
{
    return $this->belongsToMany(Facture::class);
}
public function Categorie()
{
    return $this->belongsTo(Categorie::class,'IdCategorie');
}
}
