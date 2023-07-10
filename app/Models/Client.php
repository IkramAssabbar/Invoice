<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facture;
use App\Models\FactureReccurente;
use App\Models\BonCommande;

class Client extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',	
        'email',	
        'email_verified_at',	
        'password'	,
        'nom'	,
        'prenom',	
        'tel'	,
        'if'	,
        'pays'	,
        'ice'	,
        'cp'] ;
                
                public function factures()
        {
            return $this->hasMany(Facture::class);
        }

        public function facturesReccurentes()
        {
            return $this->hasMany(FactureReccurente::class);
        }
        public function bonCommandes()
        {
            return $this->hasMany(BonCommande::class);
        }

}
