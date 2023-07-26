<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'preco', 'foto', 'data_vencimento'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function itens()
    {
        return $this->hasMany(Item::class);
    }
}
