<?php

namespace App\Http\Controllers;

use App\Exports\Produtos as ExportsProdutos;
use App\Models\Categorias;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProdutosController extends Controller
{
   public function index()
   {
      $categorias =  Categorias::get();
      return view('admin.Produtos.create', compact('categorias'));
   }


   public function store(Request $request)
   {

      $dados = $request->all();

      //  verificar se precisa criar categoria // 
      $categoria_id = $this->verifyCategory($request);

      // verificar se existe imagem, salvar e retornar path //
      $caminhoImagem = $this->verifyImage($request);

      // verificar campos vindo do formulario // 
      $descricao =  array_key_exists('Descricao', $dados) ? $dados['Descricao'] : null;
      $validade = array_key_exists('DataValidade', $dados) ? $dados['DataValidade'] : null;

      // create // 
      Produtos::create([
         'nome' => $dados['NomeDoProduto'],
         'categoria_id' => $categoria_id,
         'descricao' => $descricao,
         'preco' => $dados['Valor'],
         'Qtd_Produtos' => $dados['Quantidade'],
         'foto' =>  $caminhoImagem,
         'data_vencimento' => $validade,
      ]);
      return redirect()->route('listar.produtos');
   }

   public function verifyImage($request)
   {
      if ($request->imagem) {
         // Obtem o arquivo da requisição
         $imagem = $request->file('imagem');

         // Define um nome único para a imagem usando o timestamp atual
         $nomeImagem = $request->NomeDoProduto . '_' . time() . '.' . $imagem->extension();
         $imagem->storeAs('public/imagens', $nomeImagem);
         return  '/storage/imagens/' . $nomeImagem;
      } else {
         return  'img/add-img.png';
      }
   }

   public function verifyCategory($request)
   {
      if ($request['categoria'] == 'Criar') {
         $novaCategoria = Categorias::create(['NomeCategoria' => $request['NomeCategoria']]);
         return $novaCategoria->id;
      } else {
         return $request['categoriaID'];
      }
   }

   public function getMaxValue(Request $request)
   {
      // Fetch the maximum value for the input based on the selected product ID.
      // Replace this with your logic to determine the maximum value.

      $productId = $request->input('productId');
      $maxValue =  Produtos::where('id', $productId)->get()->value('Qtd_Produtos');
      // Your logic to determine the maximum value goes here;

      return response()->json(['maxValue' => $maxValue]);
   }

   public function adicionarProdutoCarrinho(Request $request)
   {
      // Fetch the selected product data and do some processing (e.g., fetching from the database, calculating values, etc.)

      $productId = $request->input('productId');
      $product =  Produtos::where('id', $productId)->first();
      // Replace these placeholders with actual data from the database or other sources
      $id = $product->id;
      $categoria = $product->categoria;
      // Return the product data as JSON response
      return response()->json([
         'id' => $product->id,
         'produto' => $product->nome,
         'categoria' => $categoria->NomeCategoria,
         'quantidade' => $product->Qtd_Produtos,
         'valor' => $product->preco,
         'foto' => $product->foto,
         'validade' => $product->data_vencimento,
         'descricao' => $product->descricao,
      ]);
   }
   public function listarProdutos()
   {
      $produtos = Produtos::get();
    
      return view('admin.Produtos.List', compact('produtos'));
   }

   public function editProduct(Request $request)
   {
      try {
         $produto = $request->all();
         $id = $produto['id'];
         $updateData = [
            'nome' => $produto['nome'],
            'preco' => $produto['preco'],
            'Qtd_Produtos' => $produto['qtd'],
         ];

         // Verificar e adicionar a descrição se não for nula
         if ($produto['Descricao'] != null) {
            $updateData['descricao'] = $produto['Descricao'];
         }

         // Verificar e adicionar a imagem se não for nula
         if (isset($produto['imagem'])) {
            $path = $this->verifyImage($request);
            $updateData['foto'] = $path;
         }

         Produtos::where('id', $id)->update($updateData);

         return true;

      } catch (\Throwable $th) {
         return $th;
      }
   }
   public function deleteProduto(Request $request)
   {
      $teste = $request->id;
      $deleteProduto = Produtos::where('id', $request->id)->delete();

      return true;
   }

   public function downloadListExcel()
   {
      return Excel::download(new ExportsProdutos, 'produtos'.time().'.xlsx');
   }
}
