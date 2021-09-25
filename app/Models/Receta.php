<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model

{

    protected $fillable = [
        'nombre',
        'ingredientes',
        'preparacion',
        'imagen',
        'categoria_id'
    ];

    //Obtrenr la categoria mediante la clave foranea

    public function categoriaReceta(){

        //Relacion de uno a uno 
        return $this->belongsTo(CategoriaReceta::class, 'categoria_id');
    }

    public function autorReceta(){

        //Relacion de uno a uno 
        return $this->belongsTo(User::class, 'user_id');
    }

    //Los like que a recibido la receta
    public function likes(){
        return $this->belongsToMany(User::class, 'like_recetas');
    }
}
