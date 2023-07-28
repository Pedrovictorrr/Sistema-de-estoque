<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use App\Models\ItensPedidos;
use App\Models\Produtos as ModelsProdutos;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class Ranking10 implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {   
        $contagemItens = ItensPedidos::select('id_produto', DB::raw('COUNT(*) as total'))
        ->groupBy('id_produto')
        ->orderByDesc('total')
        ->take(10)
        ->get();

    // Array para armazenar os dados dos itens mais frequentes com os nomes dos produtos
    $itensMaisFrequentes = [];

    foreach ($contagemItens as $item) {
        // Acesse o nome do produto através da relação "produto" no modelo ItensPedidos
        $produto = ModelsProdutos::find($item->id_produto); // Supondo que a chave primária na tabela produtos é "id"

        if ($produto) {
            $itensMaisFrequentes[] = [
                'id_produto' => $item->id_produto,
                'nome_produto' => $produto->nome, // Coloque o nome do campo na tabela produtos que contém o nome do produto
                'total' => $item->total,
            ];
        }
    }
        return view('admin.excel.Relatorio10Produtos', [
            'itensMaisFrequentes' => $itensMaisFrequentes
        ]);
    }
}
