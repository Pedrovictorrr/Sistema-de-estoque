<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {

        $chartData = [
            // Sample data for demonstration purposes
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [10, 20, 15, 30, 25],
        ];
        return view('admin.Relatorio.relatorio',compact('chartData'));
    }
}
