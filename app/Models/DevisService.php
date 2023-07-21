<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisService extends Model
{
    use HasFactory;
    protected $table = 'devis_services';
protected $fillable=['idService','idDevis'	];

}
