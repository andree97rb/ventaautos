<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "marca";
    protected $fillable = array('nombre');
    public $timestamps = false;

    public function auto()
    {
        return $this->hasMany('App\Models\Auto', 'idMarca');
    }
}