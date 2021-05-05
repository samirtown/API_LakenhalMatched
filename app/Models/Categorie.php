<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps = false;
    protected $table = 'categorie';
    protected $fillable = ['categorie'];
}
