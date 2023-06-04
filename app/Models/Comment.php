<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'crearted_at', 'updated_at'];

    //relacion con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion con articulos
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
