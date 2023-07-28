@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container-xxl">
        <div>
            <div class="row p-3">
                <div class="col-md-6 p-3">
                    <div class="p-2 border bg-white shadow rounded">
                        <div class="p-3 text-center">
                            <h5>Ranking dos 10 produtos com mais saída do sistema:</h5>
                        </div>
                        <canvas id="myChart"></canvas>
                        <div class="p-3 text-center">
                            <button class="btn btn-success">Donwload Excel</button>
                            <button  class="btn btn-danger">Donwload PDF</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3">
                    <div class="p-2 border bg-white shadow rounded">
                        <div class="p-3 text-center">
                            <h5>Valor gasto nos ultimos 10 dias:</h5>
                        </div>
                        <canvas id="myChart2"></canvas>
                        <div class="p-3 text-center">
                            <button class="btn btn-success">Donwload Excel</button>
                            <button  class="btn btn-danger">Donwload PDF</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-4">
                <div class="border rounded shadow bg-white p-3 col-md-12">
                    <div class="border rounded">
                        <div class=" bg-light text-center  p-2">
                            <h3>Produtos em estoque</h3>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Cod.</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Valor por unidade</th>
                                    <th scope="col">Valor em estoque</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                <tr>
                                    <th scope="row">{{$produto->id}}</th>
                                    <td>{{$produto->nome}}</td>
                                    <td>{{$produto->categoria->NomeCategoria}}</td>
                                    <td>{{$produto->Qtd_Produtos}}</td>
                                    <td>R$ {{ number_format( $produto->preco, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($produto->Qtd_Produtos * $produto->preco, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-1">
                <a href="{{ $produtos->previousPageUrl() }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" style="fill: white" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </a>
            </div>
            <div class="p-1">
                 <a href="{{ $produtos->nextPageUrl() }}" class="btn btn-primary">
                <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                </svg>
            </a> 
            </div>
            <!-- a Tag for next page -->
          
        </div>
    </div>
@stop

@section('css')


@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var itensMaisFrequentes = <?php echo $itensMaisFrequentesJson; ?>;

        // Mapear o array de itens mais frequentes para obter apenas os labels (neste caso, os nomes dos produtos)
        var labelsMaisFrequentes = itensMaisFrequentes.map(item => item.nome_produto);

        // Mapear o array de itens mais frequentes para obter apenas os valores dos itens
        var valoresMaisFrequentes = itensMaisFrequentes.map(item => item.total);

        // Concatenar os labels das 10 itens mais frequentes com os labels originais
        const labels = [
            ...labelsMaisFrequentes // Adicionar os labels dos itens mais frequentes aqui
        ];

        // Concatenar os valores dos itens mais frequentes com os valores originais
        const data = {
            labels: labels,
            datasets: [{
                label: 'Unidade',
                borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
                data: [...valoresMaisFrequentes], // Adicionar os valores dos itens mais frequentes aqui
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {}
        };



        var valorTotalPorDia = <?php echo $valorTotalPorDiaJson; ?>;

        // Mapear o objeto JavaScript para obter os índices (dias) de cada valor
        var indicesPorDia = Object.keys(valorTotalPorDia);

        // Criar os labels2 com os índices (dias) dos valores
        const labels2 = indicesPorDia;

        // Mapear o objeto JavaScript para obter os valores de cada dia
        var valoresPorDia = Object.values(valorTotalPorDia);

        // Adicionar os valores dos dias ao data2
        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'R$',
                borderColor: '#36A2EB',
      backgroundColor: '#9BD0F5',
                data: valoresPorDia,
            }]
        };

        // Agora você pode usar as variáveis 'labels2' e 'data2' em seu código JavaScript
        // Por exemplo, para imprimir os dados no console:
        console.log(labels2);
        console.log(data2);

        const config2 = {
            type: 'line',
            data: data2,
            options: {}
        };
    </script>
    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script>
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );
    </script>
@stop
