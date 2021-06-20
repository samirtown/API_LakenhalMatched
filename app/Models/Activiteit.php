<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activiteit extends Model
{
    protected $primaryKey = 'activiteit_ID';
    protected $table = 'activiteit';
    protected $fillable = ['activiteit'];
    
}
