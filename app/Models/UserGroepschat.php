<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroepschat extends Model
{
    public $timestamps = false;
    protected $table = 'user_groepschat';
    protected $fillable = ['user_groepschat'];
}
