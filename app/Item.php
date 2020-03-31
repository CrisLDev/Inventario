<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //Scope
    public function scopeNombre($query, $nombre){
        if($nombre)return $query->where('nombre', 'LIKE', "%$nombre%");
    }

    public function scopeCurso($query, $curso){
        if($curso)return $query->where('curso', 'LIKE', "%$curso%")->orWhere('paralelo', 'LIKE', "%$curso%");
    }

    public function scopeDescripcion($query, $descripcion){
        if($descripcion)return $query->where('descripcion', 'LIKE', "%$descripcion%");
    }
}
