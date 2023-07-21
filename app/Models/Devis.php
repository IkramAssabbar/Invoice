<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable=['date'	,'status',	'montantTotal',	'montantHtva',	'tva',	'remise',	'IdHistorique',	'IdService',	'IdClient'];
    public function Services()
{
    return $this->belongsToMany(Service::class,'devis_services', 'idDevis', 'idService');
}
public function Client()
{
    return $this->belongsTo(Client::class,'IdClient');
}
public function getRetardAttribute()
    {
        $echeance = Carbon::parse($this->attributes['echeance']);
        $aujourdHui = Carbon::today();

        if ($aujourdHui > $echeance) {
            $retard = $aujourdHui->diffInDays($echeance);
        } else {
            $retard = 0;
        }

        return $retard;
    }



}
