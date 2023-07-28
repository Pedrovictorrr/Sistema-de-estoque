<?php

namespace App\Exports;

use App\Invoice;
use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos as ModelsProdutos;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ValorGastoUltimos10 implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
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

        return view('admin.excel.ValorGastoUltimos10', [
            'valorTotalPorDia' => $valorTotalPorDia
        ]);
    }
}
