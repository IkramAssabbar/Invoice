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
    return $this->belongsToMany(Facture::class,'facture_service', 'idFacture', 'idService');
}
public function FacturesReccurentes()
{
    return $this->belongsToMany(FactureReccurente::class,'facture_rec_services', 'idFactureRecu', 'idServiceRec');
}
public function BonCommandes()
{
    return $this->belongsToMany(BonCommande::class,'bon_commande_services', 'idBonCommd', 'idService');
}
public function BonLivraisons()
{
    return $this->belongsToMany(BonLivraison::class,'bon_livraison_services', 'idBonLivr', 'idService');
}
public function Categorie()
{
    return $this->belongsTo(Categorie::class,'IdCategorie');
}
public function Devis()
{
    return $this->belongsToMany(Devis::class,'devis_services', 'idDevis', 'idService');
}
}
