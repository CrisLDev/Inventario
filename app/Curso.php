<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //Scope
    public function scopeCurso($query, $curso){
        if($curso)return $query->where('curso', 'LIKE', "%$curso%")->orWhere('paralelo', 'LIKE', "%$curso%");
    }

    public function scopeDescripcion($query, $descripcion){
        if($descripcion)return $query->where('descripcion', 'LIKE', "%$descripcion%");
    }
}
