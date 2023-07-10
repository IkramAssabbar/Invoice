<?php

namespace App\Models;
use App\Models\Service;
use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
   protected $fillable = ['id','date','echeance','status','montantTotal','montantHtva','tva','remise','IdClient'];

    public function Client()
{
    return $this->belongsTo(Client::class,'IdClient');
}
public function Services()
{
    return $this->belongsToMany(Service::class);
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
