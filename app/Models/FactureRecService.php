<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureRecService extends Model
{
    use HasFactory;
    protected $fillable=['idFactureRecu',	'idServiceRec'];
}
