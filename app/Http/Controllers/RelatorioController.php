<?php

namespace App\Http\Controllers;

use App\Exports\ProdutosEstoque;
use App\Exports\Ranking10;
use App\Exports\ValorGastoUltimos10;
use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        $produtos = Produtos::where('Qtd_Produtos', '>', 0)->get();


        return view('admin.Relatorio.relatorio', compact('itensMaisFrequentesJson', 'valorTotalPorDiaJson', 'produtos'));
    }

    public function generatePDFRanking10()
    {

        // Obter a contagem dos itens mais frequentes (10 produtos que mais aparecem)
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

        // Carrega a view 'admin.pdf.Relatorio10Produtos' com os dados dos itens mais frequentes
        $pdf = PDF::loadView('admin.pdf.Relatorio10Produtos', compact('itensMaisFrequentes'))
            ->setPaper('a4');

        // Retorna o PDF para download ou visualização (stream)
        return $pdf->stream('relatorio_10_produtos.pdf');
    }

    public function generateExcelRanking10()
    {
       return Excel::download(new Ranking10, 'pedidos'.time().'.xlsx');
    }

    public function generatePDFVAlorTotalGasto()
    {

        $currentDate = Carbon::now();

        // Obtém a data há 10 dias atrás
        $tenDaysAgo = Carbon::now()->subDays(10);

        // Consulta para obter os pedidos nos últimos 10 dias
        $pedidos = Pedidos::whereBetween('created_at', [$tenDaysAgo, $currentDate])->get();

        // Array para armazenar o valor total de cada dia
        $valorTotalPorDia = [];

        // Loop pelos pedidos para calcular o valor total de cada dia
        foreach ($pedidos as $pedido) {
            // Obtém a data do pedido formatada apenas com a parte da data (sem a hora)
            $dataPedido = Carbon::parse($pedido->created_at)->format('d/m/Y');

            // Verifica se a data já está no array, caso contrário, inicia com zero
            if (!isset($valorTotalPorDia[$dataPedido])) {
                $valorTotalPorDia[$dataPedido] = 0;
            }

            // Soma o valor total do pedido ao valor total daquele dia
            $valorTotalPorDia[$dataPedido] += $pedido->Valor_total;
        }

        // Carrega a view do PDF com os dados
        $pdf = PDF::loadView('admin.pdf.RelatorioValorGasto', compact('valorTotalPorDia'))
                ->setPaper('a4');

        // Retorna o PDF para download ou visualização (stream)
        return $pdf->stream('relatorio_10_produtos.pdf');
      
    }


    public function generateExcelVAlorTotalGasto()
    {
       return Excel::download(new ValorGastoUltimos10, 'ValorGasto10Dias'.time().'.xlsx');
    }

    public function generatePDFProdutosEstoque()
    {

        $produtos = Produtos::where('Qtd_Produtos', '>', 0)->get();

        // Carrega a view do PDF com os dados
        $pdf = PDF::loadView('admin.pdf.ProdutosEmEstoque', compact('produtos'))
                ->setPaper('a4');

        // Retorna o PDF para download ou visualização (stream)
        return $pdf->stream('ProdutosEstoque.pdf');
      
    }


    public function generateExcelProdutosEstoque()
    {
       return Excel::download(new ProdutosEstoque, 'Produto_estoque_'.time().'.xlsx');
    }
}
