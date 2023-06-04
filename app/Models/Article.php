<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'crearted_at', 'updated_at'];

    //relacion con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion con comentarios
    public function comments(){
        return $this->hasMany(Comment::class);
    }

     //relacion con Categorias
     public function category(){
        return $this->belongsTo(Category::class);
    }
}
