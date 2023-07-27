<?php

namespace Database\Seeders;

use App\Models\Pedidos;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Criar 1000 pedidos aleatórios vinculados aos usuários
        Pedidos::factory()->count(1000)->create([
            'user_id' => $users->random()->id,
        ]);

        // Atualizar o valor total e a quantidade total de itens em cada pedido
        Pedidos::all()->each(function ($pedido) {
            $itensPedido = $pedido->itensPedido;
            $valorTotal = $itensPedido->sum(function ($item) {
                return $item->Qtd_produtos * $item->produto->preco;
            });
            $quantidadeTotal = $itensPedido->sum('Qtd_produtos');
            $pedido->update([
                'Valor_total' => $valorTotal,
                'Qtd_itens' => $quantidadeTotal,
            ]);
        });
    }
}
