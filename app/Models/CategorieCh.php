<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieCh extends Model
{
    use HasFactory;
    protected $table = 'categoriesch';

    protected $fillable=['nomCategorie'];
    public function Charges()
    {
        return $this->hasMany(Charge::class);
    }
}
