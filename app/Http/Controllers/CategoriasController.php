<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Produtos;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function create($content)
    {
        $novaCategoria = Categorias::create(['NomeCategoria' => $content['NomeCategoria']]);
        return $novaCategoria->id;
    }

    public function listarCategorias()
    {
        $categorias =  Categorias::get();
        $produtos = Produtos::get();
        return view('admin.Categorias.List', compact('categorias', 'produtos'));
    }

    public function editCategorias(Request $request)
    {
        try {
            $dados = json_decode($request->jsonData);
            $produtos = $dados->idProduto;
            $categoria_id = $dados->CategoriaId;

            //update tables
            Produtos::whereIn('id', $produtos)
                ->update(['categoria_id' => $categoria_id]);

            Categorias::where('id', $categoria_id)
                ->update(['NomeCategoria' => $dados->NomeCategoria]);


            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createCategorias(Request $request)
    {
        try {
            $dados = $request->all();

            $create = Categorias::create(['NomeCategoria' => $dados['nomeCategoria']]);

            $newCategoryId = $create->id;


            $selectedProductsIds = array_map(function ($product) use ($newCategoryId) {
                return substr($product, 0, 1);
            }, $dados['selectedProducts']);

            Produtos::whereIn('id', $selectedProductsIds)
                ->update(['categoria_id' => $newCategoryId]);

            $categoria = Categorias::where('id', $create->id)->get();
            $json = [
                'id' => $categoria->id,
                'NomeCategoria' => $categoria->NomeCategoria,
                'Qtd_produtos' => $categoria->produtos->count(),
                'Ticket_medio' => number_format($categoria->produtos->sum('preco') / $categoria->produtos->count(), 2, ',', '')
            ];
            $json = json_encode($json);
            return $json;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function deleteCategorias(Request $request)
    {
        try {
            Categorias::where('id', $request->id)->delete();
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
