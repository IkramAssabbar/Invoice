<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Client;
class BonLivraison extends Model
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
        $dateLivraison = Carbon::parse($this->attributes['echeance']);
        $aujourdHui = Carbon::today();

        if ($aujourdHui > $dateLivraison) {
            $retard = $aujourdHui->diffInDays($dateLivraison);
        } else {
            $retard = 0;
        }

        return $retard;
    }
}
