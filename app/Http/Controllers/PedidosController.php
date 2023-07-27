<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {   
        $produtos = Produtos::get();
        
        return view('admin.Pedido',compact('produtos'));
    }
}
