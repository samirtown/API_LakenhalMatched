<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groepschat extends Model
{
    public $timestamps = false;
    protected $table = 'groepschat';
    protected $fillable = ['user_groepschat'];
}
