<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\RelatorioController;
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



Auth::routes();
Route::middleware('auth')->group(function () {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas de pedido // 
Route::get('/fazer-pedido',[PedidosController::class,'index'])->name('fazer.pedido');
Route::get('/show-pedido/{id}',[PedidosController::class,'show'])->name('show.pedido');
Route::get('/pdf-pedido/{id}',[PedidosController::class,'generatePDf'])->name('pdf.pedido');
Route::post('/enviar-pedido',[PedidosController::class,'store'])->name('enviar.pedido');
Route::get('/listarPedidos', [PedidosController::class, 'listarPedidos'])->name('listar.pedidos');
Route::get('/PedidosListExcel', [PedidosController::class, 'downloadListExcel'])->name('downloadListExcel.Pedidos');

// Rotas de produto // 
Route::get('/inserir-produto',[ProdutosController::class,'index'])->name('inserir.produto');
Route::post('/enviar-produto',[ProdutosController::class,'store'])->name('enviar.produto');
Route::post('/getMaxValue', [ProdutosController::class, 'getMaxValue']);
Route::post('/adicionarProdutoCarrinho', [ProdutosController::class, 'adicionarProdutoCarrinho']);
Route::post('/editProduct', [ProdutosController::class, 'editProduct']);
Route::get('/listarProdutos', [ProdutosController::class, 'listarProdutos'])->name('listar.produtos');
Route::post('/delete-produto', [ProdutosController::class, 'deleteProduto'])->name('delete.produtos');
Route::get('/ProdutosListExcel', [ProdutosController::class, 'downloadListExcel'])->name('downloadListExcel.produtos');


// Rotas de Relatorio // 

Route::get('/Relatorios', [RelatorioController::class, 'index'])->name('relatorios');
Route::get('/generatePDFRanking10', [RelatorioController::class, 'generatePDFRanking10'])->name('generatePDFRanking10');
Route::get('/generateExcelRanking10', [RelatorioController::class, 'generateExcelRanking10'])->name('generateExcelRanking10');
Route::get('/generatePDFVAlorTotalGasto', [RelatorioController::class, 'generatePDFVAlorTotalGasto'])->name('generatePDFVAlorTotalGasto');
Route::get('/generatePDFProdutosEstoque', [RelatorioController::class, 'generatePDFProdutosEstoque'])->name('generatePDFProdutosEstoque');
Route::get('/generateExcelRanking10', [RelatorioController::class, 'generateExcelRanking10'])->name('generateExcelRanking10');
Route::get('/generateExcelVAlorTotalGasto', [RelatorioController::class, 'generateExcelVAlorTotalGasto'])->name('generateExcelVAlorTotalGasto');
Route::get('/generateExcelProdutosEstoque', [RelatorioController::class, 'generateExcelProdutosEstoque'])->name('generateExcelProdutosEstoque');


});
