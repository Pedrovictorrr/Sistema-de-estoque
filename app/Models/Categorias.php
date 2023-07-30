<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    
    protected $fillable = ['NomeCategoria'];


    public function produtos()
    {
        return $this->hasMany(Produtos::class,'categoria_id');
    }
}
