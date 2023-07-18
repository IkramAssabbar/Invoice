<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    protected $fillable=['libelle','prix','tva','description','categorieid'	];
    public function Categoriech()
{
    return $this->belongsTo(Categoriech::class,'categorieid');
}
}
