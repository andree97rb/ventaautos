<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $table = "auto";
    protected $fillable = array('modelo', 'placa', 'color', 'idMarca');
    public $timestamps = false;
    
    public function marca() {
        return $this->belongsTo('App\Models\Marca', 'idMarca');
    }
}