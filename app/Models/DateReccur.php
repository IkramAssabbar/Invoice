<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateReccur extends Model
{
    use HasFactory;
    protected $fillable=['date_envoie','stopenvoie','frequence'];
}
