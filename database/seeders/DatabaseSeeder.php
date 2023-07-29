<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categorias;
use App\Models\ItensPedidos;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
          
        User::factory()->create([
            'name' => 'Teste User',
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456'),
        ]);
        User::factory()->create([
            'name' => 'W2O teste',
            'email' => 'w2o@teste.com',
            'password' => bcrypt('123456'),
        ]);
        User::factory()->create([
            'name' => 'Joao teste',
            'email' => 'joao@teste.com',
            'password' => bcrypt('123456'),
        ]);
        User::factory()->create([
            'name' => 'Pedro teste',
            'email' => 'pedro@teste.com',
            'password' => bcrypt('123456'),
        ]);
        User::factory()->create([
            'name' => 'Carlos teste',
            'email' => 'carlos@teste.com',
            'password' => bcrypt('123456'),
        ]);

        // Chamada para o seeder de categorias que você criou
        $this->call(CategoriasTableSeeder::class);
        // Chamada para o seeder de produtos que você criou
        $this->call(ProdutosTableSeeder::class);
        // Chamada para o seeder de pedidos que você criou
        $this->call(PedidosTableSeeder::class);
        // Chamada para o seeder de itens de pedido que você criou
        $this->call(ItensPedidosTableSeeder::class);



    
        
    }
}
