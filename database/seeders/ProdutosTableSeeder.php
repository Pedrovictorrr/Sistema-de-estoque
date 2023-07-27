<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categorias::all();

        // Criar 500 produtos aleatórios vinculados às categorias
        Produtos::factory()->count(500)->create([
            'categoria_id' => $categorias->random()->id,
        ]);
    }
}
