<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use App\Models\Produtos as ModelsProdutos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ProdutosEstoque implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.excel.ProdutosEstoque', [
            'produtos' => ModelsProdutos::where('Qtd_Produtos', '>', 0)->get()
        ]);
    }
}
