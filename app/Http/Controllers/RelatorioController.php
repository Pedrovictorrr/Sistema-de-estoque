<?php

namespace App\Http\Controllers;

use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        // Obter todos os registros da tabela ItensPedidos
        $contagemItens = ItensPedidos::select('id_produto', DB::raw('COUNT(*) as total'))
        ->groupBy('id_produto')
        ->orderByDesc('total')
        ->take(10)
        ->get();
    
    // Array para armazenar os dados dos itens mais frequentes com os nomes dos produtos
    $itensMaisFrequentes = [];
    
    foreach ($contagemItens as $item) {
        // Acesse o nome do produto através da relação "produto" no modelo ItensPedidos
        $produto = Produtos::find($item->id_produto); // Supondo que a chave primária na tabela produtos é "id"
    
        if ($produto) {
            $itensMaisFrequentes[] = [
                'id_produto' => $item->id_produto,
                'nome_produto' => $produto->nome, // Coloque o nome do campo na tabela produtos que contém o nome do produto
                'total' => $item->total,
            ];
        }
    }

        $itensMaisFrequentesJson = json_encode($itensMaisFrequentes);
        // Obter todos os pedidos da tabela Pedidos
        $pedidos = Pedidos::all();

        // Array para armazenar o valor total gasto em cada dia
        $valorTotalPorDia = [];

        // Iterar pelos pedidos para calcular o valor total por dia
        foreach ($pedidos as $pedido) {
            $dataPedido = $pedido->created_at->format('Y-m-d'); // Obter a data do pedido formatada como Y-m-d

            // Se já tiver um registro para o dia, adiciona o valor ao valor total existente
            if (array_key_exists($dataPedido, $valorTotalPorDia)) {
                $valorTotalPorDia[$dataPedido] += $pedido->Valor_total;
            } else { // Se for o primeiro pedido para o dia, cria o registro no array
                $valorTotalPorDia[$dataPedido] = $pedido->Valor_total;
            }
        }
        $valorTotalPorDiaJson = json_encode($valorTotalPorDia);
        $produtos = Produtos::query();
        $produtos = $produtos->paginate(5);

        return view('admin.Relatorio.relatorio', compact('itensMaisFrequentesJson', 'valorTotalPorDiaJson','produtos'));
    }
}
