<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use App\Models\Produtos as ModelsProdutos;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Produtos implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return ModelsProdutos::all();
    // }

    public function view(): View
    {
        return view('admin.excel.ProdutosList', [
            'produtos' => ModelsProdutos::all()
        ]);
    }
}
