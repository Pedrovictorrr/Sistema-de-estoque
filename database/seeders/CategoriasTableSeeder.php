<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriasAlmoxarifado = [
            'Materiais de Escritório',
            'Equipamentos de Segurança',
            'Peças de Reposição',
            'Ferramentas',
            'Embalagens'
        ];

        foreach ($categoriasAlmoxarifado as $categoria) {
            Categorias::create([
                'NomeCategoria' => $categoria,
            ]);
        }
    }
}
