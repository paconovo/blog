<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'crearted_at', 'updated_at'];

    //relacion con profile
    public function user(){
        return $this->belongsTo(User::class);
    }
}
