<?php

namespace App\Http\Controllers;

use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::get();

        return view('admin.Pedido.Create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $user_id = '1';
        $itens = $request->produtosArray;
        $produtosDecodificados = [];
        $valorTotal = 0;
        $Qtd_items = 0;

        $pedido =  Pedidos::create([
            'user_id' => $user_id,
            'Valor_total' => '0',
            'Qtd_itens' => '0',
        ]);
        $pedido = $pedido->id;


        foreach ($itens as $item) {
            $itens = json_decode($item, true);
            if (is_array($itens) && !empty($itens)) {


                $produtosDecodificados[] = $itens;
                $valorTotal += floatval($itens['valor']) * intval($itens['quantidade']);
                $Qtd_items += intval($itens['quantidade']);

                ItensPedidos::create([
                    'id_produto' => $itens['id'],
                    'id_pedido' => $pedido,
                    'Qtd_produtos' => $itens['quantidade'],
                    'status' => '1',
                ]);

                // atualizando quantidade estoque // 
                $Qtd_Estoque = Produtos::where('id', $itens['id'])->get()->value('Qtd_Produtos');
                $Qtd_Estoque -= $itens['quantidade'];
                $Qtd_Estoque =  Produtos::where('id', $itens['id'])->update(['Qtd_Produtos' => $Qtd_Estoque]);
            } else {
                // Se o JSON não pôde ser convertido ou estiver vazio, você pode lidar com isso de acordo com suas necessidades (ignorar, registrar erro, etc.)
            }

            Pedidos::where('id', $pedido)->update(['Valor_total' => $valorTotal, 'Qtd_itens' => $Qtd_items]);
        }

        return redirect()->route('show.pedido', ['id' => $pedido]);
    }

    public function show($id)
    {
        $pedido = Pedidos::where('id', $id)->first();
        $user = User::where('id', $pedido->user_id)->first();
        $itens = ItensPedidos::where('id_pedido', $id)->get();
        $hash = Hash::make($user);
        

        return view('admin.Pedido.Show', compact('pedido', 'user', 'itens','hash'));
    }

    public function generatePDf($id)
    {   
        $pedido = Pedidos::where('id', $id)->first();
        $user = User::where('id', $pedido->user_id)->first();
        $itens = ItensPedidos::where('id_pedido', $id)->get();
        $hash = Hash::make($user);
       return Pdf::loadView('admin.pdf.pdf', compact('pedido', 'user', 'itens','hash'))->setPaper('a4')->stream();
    }
}
