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
        $produtos = Produtos::all();
        $pedidos = Pedidos::all();

        // Criar 5000 itens de pedido aleatórios vinculados aos produtos e pedidos
        foreach ($pedidos as $pedido) {
            $qtdItens = rand(1, 5); // Definir uma quantidade aleatória de itens para cada pedido
            for ($i = 0; $i < $qtdItens; $i++) {
                $produto = $produtos->random();
                $quantidade = rand(1, 10); // Definir uma quantidade aleatória para cada item
                $valorTotalItem = $produto->preco * $quantidade;
                ItensPedidos::create([
                    'id_produto' => $produto->id,
                    'id_pedido' => $pedido->id,
                    'Qtd_produtos' => $quantidade,
                    'status' => 'pendente', // Definir o status inicial para cada item
                ]);

                // Atualizar o valor total e a quantidade total de itens no pedido
                $pedido->update([
                    'Valor_total' => $pedido->Valor_total + $valorTotalItem,
                    'Qtd_itens' => $pedido->Qtd_itens + $quantidade,
                ]);
            }
        }
    }
}
