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
        $produtos = [
            [
                'nome' => 'Caneta Esferográfica Azul',
                'categoria_id' => 1, // ID da categoria 'Materiais de Escritório'
                'descricao' => 'Pacote com 10 unidades de canetas azuis.',
                'preco' => 5.99,
                'Qtd_Produtos' => 100,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Capacete de Segurança',
                'categoria_id' => 2, // ID da categoria 'Equipamentos de Segurança'
                'descricao' => 'Capacete de segurança resistente a impactos.',
                'preco' => 29.90,
                'Qtd_Produtos' => 50,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Teclado USB',
                'categoria_id' => 1, // ID da categoria 'Materiais de Escritório'
                'descricao' => 'Teclado USB para computadores.',
                'preco' => 45.50,
                'Qtd_Produtos' => 30,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Luvas de Proteção',
                'categoria_id' => 2, // ID da categoria 'Equipamentos de Segurança'
                'descricao' => 'Par de luvas de proteção contra riscos mecânicos.',
                'preco' => 9.75,
                'Qtd_Produtos' => 80,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Chave de Fenda',
                'categoria_id' => 4, // ID da categoria 'Ferramentas'
                'descricao' => 'Chave de fenda de ponta chata para reparos.',
                'preco' => 7.20,
                'Qtd_Produtos' => 60,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Papel Sulfite A4',
                'categoria_id' => 1, // ID da categoria 'Materiais de Escritório'
                'descricao' => 'Pacote com 500 folhas de papel sulfite formato A4.',
                'preco' => 19.99,
                'Qtd_Produtos' => 20,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Óculos de Proteção',
                'categoria_id' => 2, // ID da categoria 'Equipamentos de Segurança'
                'descricao' => 'Óculos de proteção com lentes anti-risco.',
                'preco' => 12.80,
                'Qtd_Produtos' => 40,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Alicate Universal',
                'categoria_id' => 4, // ID da categoria 'Ferramentas'
                'descricao' => 'Alicate multiuso para diversos tipos de trabalho.',
                'preco' => 15.50,
                'Qtd_Produtos' => 35,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Caixa de Papelão',
                'categoria_id' => 5, // ID da categoria 'Embalagens'
                'descricao' => 'Caixa de papelão resistente para embalagem.',
                'preco' => 2.99,
                'Qtd_Produtos' => 200,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
            [
                'nome' => 'Tesoura Escolar',
                'categoria_id' => 1, // ID da categoria 'Materiais de Escritório'
                'descricao' => 'Tesoura escolar com lâminas de aço inoxidável.',
                'preco' => 6.25,
                'Qtd_Produtos' => 70,
                'foto' => 'img/add-img.png',
                'data_vencimento' => null,
            ],
        ];

        foreach ($produtos as $produto) {
           Produtos::create($produto);
        }
    }
}
