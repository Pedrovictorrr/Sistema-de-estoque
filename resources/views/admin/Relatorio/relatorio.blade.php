@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1 class="text-center">Relatorios</h1>
    </div>

@stop

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container-xxl">
        <div>
            <div class="row p-3">
                <div class="col-md-6 p-3">
                    <div class="p-2 border bg-white shadow rounded">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6 p-3">
                    <div class="p-2 border bg-white shadow rounded">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
            <div class="row p-4">
                <div class="border rounded shadow bg-white p-3 col-md-12">
                    <div class="border rounded">
                        <div class=" bg-light text-center  p-2">
                            <h3>Numero de produtos</h3>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@stop

@section('css')


@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'April',
            'May',
            'June',
            'Produto10'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Ranking com os 10 produtos com mais saída do sistema',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };



        const labels2 = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10'
        ];

        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'Valor gasto nos ultmios 10 dias',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };

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
