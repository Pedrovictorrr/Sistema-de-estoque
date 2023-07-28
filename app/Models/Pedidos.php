<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'Valor_total', 'Qtd_itens','Destinatario'];

    public function itens()
    {
        return $this->hasMany(ItensPedidos::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function destinatario()
    {
        return $this->belongsTo(User::class, 'Destinatario');
    }
}
