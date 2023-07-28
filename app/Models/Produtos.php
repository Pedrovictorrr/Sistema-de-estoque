<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao','categoria_id', 'Qtd_Produtos','preco', 'foto', 'data_vencimento'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class,'categoria_id');
    }

    public function itens()
    {
        return $this->hasMany(ItensPedidos::class);
    }
}
