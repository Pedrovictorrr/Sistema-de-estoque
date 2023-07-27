<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function create($content)
    {
        $novaCategoria = Categorias::create(['NomeCategoria' => $content['NomeCategoria']]);
        return $novaCategoria->id;
    }
}
