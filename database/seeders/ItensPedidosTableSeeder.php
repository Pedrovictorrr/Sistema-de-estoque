<?php

namespace Database\Seeders;

use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItensPedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalItensPedidos = 50;

        $produtos = Produtos::all();
        $pedidos = Pedidos::all();

        foreach (range(1, $totalItensPedidos) as $index) {
            $produto = $produtos->random();
            $pedido = $pedidos->random();

            $qtdProdutos = mt_rand(1, 5);

            ItensPedidos::create([
                'id_produto' => $produto->id,
                'id_pedido' => $pedido->id,
                'Qtd_produtos' => $qtdProdutos,
                'status' => 'Aguardando',

            ]);
        }

        // Atualizar os valores totais e quantidades de itens dos pedidos
        foreach ($pedidos as $pedido) {
            $valorTotalPedido = $pedido->itens->sum(function ($item) {
                return $item->produto->preco * $item->Qtd_produtos;
            });

            $qtdTotalItens = $pedido->itens->sum('Qtd_produtos');

            $pedido->update([
                'Valor_total' => $valorTotalPedido,
                'Qtd_itens' => $qtdTotalItens,
            ]);
        }
    }
}
