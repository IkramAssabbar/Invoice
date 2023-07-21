<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommandeService extends Model
{
    use HasFactory;
    protected $table = 'bon_commande_services';
    protected $fillable=['idService','idBonCommd'];
}
