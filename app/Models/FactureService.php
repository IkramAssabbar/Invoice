<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureService extends Model
{
    use HasFactory;
    protected $table = 'facture_service';
    protected $fillable=['idFacture','idService'];
}
