<?php

namespace App\Http\Controllers;

use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today()->toDateString(); // Obtém a data de hoje no formato 'Y-m-d'

        // Obtém a soma dos 'Valor_total' dos registros com a data de hoje
        $valortotalgastoHoje = Pedidos::whereDate('created_at', $today)->sum('Valor_total');

        $valortotalgasto = Pedidos::sum('Valor_total');
        $valorTotalProdutos = Produtos::sum(DB::raw('preco * Qtd_produtos'));
        $quantidadepedidos = Pedidos::count();
        $categoriasMaisApareceram = ItensPedidos::with('produto.categoria') // Carrega os relacionamentos 'produto' e 'categoria'
            ->groupBy('id_produto')
            ->selectRaw('id_produto, count(*) as total')
            ->orderByDesc('total')
            ->take(4) // Obtém as 4 categorias com mais ocorrências
            ->get();
        $user = User::query();
        $users = $user->paginate(5);


        $pedidosPorMes = Pedidos::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();
    
        $valores = $pedidosPorMes->pluck('total')->toArray();
    
        $labels = $pedidosPorMes->map(function ($pedido) {
            setlocale(LC_TIME, 'pt_BR.utf8'); // Define a localização para português brasileiro
            return strftime('%B', mktime(0, 0, 0, $pedido->mes, 1));
        })->toArray();
    
        // Compacte o valor e passe-o para a view 'home'
        return view('home', compact('labels', 'valores', 'valortotalgasto', 'valorTotalProdutos', 'valortotalgastoHoje', 'quantidadepedidos', 'categoriasMaisApareceram', 'users'));
    }
    function getNomeMes($numeroMes)
    {
        $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        return $meses[$numeroMes - 1];
    }
}
