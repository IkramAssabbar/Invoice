<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable=['Nom_Categorie']	;	
    public function Services()
    {
        return $this->hasMany(Service::class);
    }
}
