<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/fazer-pedido',[PedidosController::class,'index'])->name('fazer.pedido');

// Rotas de produto // 
Route::get('/inserir-produto',[ProdutosController::class,'index'])->name('inserir.produto');
Route::post('/enviar-produto',[ProdutosController::class,'store'])->name('enviar.produto');
Route::post('/getMaxValue', [ProdutosController::class, 'getMaxValue']);
Route::post('/adicionarProdutoCarrinho', [ProdutosController::class, 'adicionarProdutoCarrinho']);
