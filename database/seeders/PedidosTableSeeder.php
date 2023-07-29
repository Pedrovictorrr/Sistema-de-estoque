<?php

namespace Database\Seeders;

use App\Models\Pedidos;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalPedidos = 20;
        $users = User::all();

        for ($i = 0; $i < $totalPedidos; $i++) {
            $user = $users->random();
            $destinatario = $users->except($user->id)->random();

            // Gerar datas aleatórias dentro do mesmo ano
            $year = date('Y'); // Ano atual
            $month = mt_rand(1, 12); // Mês aleatório (de 1 a 12)
            $day = mt_rand(1, 28); // Dia aleatório (de 1 a 28)
            $hour = mt_rand(0, 23); // Hora aleatória (de 0 a 23)
            $minute = mt_rand(0, 59); // Minuto aleatório (de 0 a 59)
            $second = mt_rand(0, 59); // Segundo aleatório (de 0 a 59)

            // Criar data no formato "Y-m-d H:i:s"
            $dataPedido = sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, $hour, $minute, $second);

            Pedidos::create([
                'user_id' => $user->id,
                'Destinatario' => $destinatario->id,
                'Valor_total' => 0,
                'Qtd_itens' => 0,
                'created_at' => $dataPedido,
                'updated_at' => $dataPedido,
            ]);
        }
    }
}
