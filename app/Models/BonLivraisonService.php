<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraisonService extends Model
{
    use HasFactory;
    protected $table = 'bon_livraison_services';
    protected $fillable=['idService','idBonLivr'];
    public function Services()
{
    return $this->belongsToMany(Service::class,'bon_livraison_services', 'idBonLivr', 'idService');
}

}
