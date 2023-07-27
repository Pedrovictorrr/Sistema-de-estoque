<?php

namespace Database\Factories;

use App\Models\Produtos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Produtos::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph(2),
            'categoria_id' => function () {
                // Aqui você pode retornar o ID de uma categoria existente ou criar uma lógica para selecionar um ID válido.
                // Exemplo: return \App\Models\Categoria::inRandomOrder()->first()->id;
                return 1; // Apenas um exemplo, você precisa ajustar isso de acordo com sua lógica.
            },
            'Qtd_Produtos' => $this->faker->numberBetween(1, 100),
            'preco' => $this->faker->randomFloat(2, 10, 100),
            'foto' => $this->faker->imageUrl(640, 480, 'products', true), // Exemplo de URL de imagem aleatória
            'data_vencimento' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'), // Exemplo de data aleatória entre hoje e 1 ano no futuro
            // Outros atributos aqui...
        ];
    }
}
