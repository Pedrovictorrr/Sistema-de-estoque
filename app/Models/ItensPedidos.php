<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensPedidos extends Model
{
    use HasFactory;


    protected $fillable = ['id_produto', 'Qtd_produtos', 'status','id_pedido'];
    protected $table = 'itens_pedidos';
    public function pedido()
    {
        return $this->belongsTo(Pedidos::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'id_produto');
    }
}
