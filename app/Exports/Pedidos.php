<?php

namespace App\Exports;

use App\Models\Pedidos as ModelsPedidos;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use App\Models\Produtos as ModelsProdutos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Pedidos implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.excel.PedidosList', [
            'pedidos' => ModelsPedidos::all()
        ]);
    }
}
