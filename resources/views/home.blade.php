@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="col-md-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Pedidos por mês</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">


                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong></strong>
                        </p>
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>

                            <canvas id="salesChart" height="360" style="height: 180px; display: block; width: 480px;"
                                width="960" class="chartjs-render-monitor"></canvas>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Produtos mais pedidos</strong>
                        </p>
                        <div class="progress-group">
                            {{ $categoriasMaisApareceram[0]->produto->nome }}
                            <span class="float-right"><b> {{ $categoriasMaisApareceram[0]->total }}</b></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary"
                                    style="width: {{ ($categoriasMaisApareceram[0]->total / $categoriasMaisApareceram[0]->total) * 100 }}%">
                                </div>
                            </div>
                        </div>

                        <div class="progress-group">
                            {{ $categoriasMaisApareceram[1]->produto->nome }}
                            <span class="float-right"><b> {{ $categoriasMaisApareceram[1]->total }}</b></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger"
                                    style="width:  {{ ($categoriasMaisApareceram[1]->total / $categoriasMaisApareceram[0]->total) * 100 }}%">
                                </div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <span class="progress-text"> {{ $categoriasMaisApareceram[2]->produto->nome }} </span>
                            <span class="float-right"><b>{{ $categoriasMaisApareceram[2]->total }}</b></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success"
                                    style="width: {{ ($categoriasMaisApareceram[2]->total / $categoriasMaisApareceram[0]->total) * 100 }}%">
                                </div>
                            </div>
                        </div>

                        <div class="progress-group">
                            {{ $categoriasMaisApareceram[3]->produto->nome }}
                            <span class="float-right"><b>{{ $categoriasMaisApareceram[3]->total }}</b></span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning"
                                    style="width: {{ ($categoriasMaisApareceram[3]->total / $categoriasMaisApareceram[0]->total) * 100 }}%">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                            </span>
                            <h5 class="description-header">R$ {{ number_format($valortotalgasto, 2, ',', '.') }}</h5>
                            <span class="description-text">VALOR TOTAL GASTOS EM PEDIDOS</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> </span>
                            <h5 class="description-header">R$ {{ number_format($valorTotalProdutos, 2, ',', '.') }}</h5>
                            <span class="description-text">VALOR TOTAL EM ESTOQUE</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                            </span>
                            <h5 class="description-header"> R$ {{ number_format($valortotalgastoHoje, 2, ',', '.') }}</h5>
                            <span class="description-text">VALOR TOTAL GASTO EM PEDIDOS HOJE</span>
                        </div>

                    </div>

                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                            </span>
                            <h5 class="description-header">{{ $quantidadepedidos }}</h5>
                            <span class="description-text">TOTAL DE PEDIDOS</span>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabela de Usuarios</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Total de gastos</th>
                                        <th>Ultima Atualização do perfil</th>
                                        <th>Data de criação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>R$ {{ number_format($user->pedidos->sum('Valor_total'), 2, ',', '.') }}
                                            </td>
                                            <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Total de gastos</th>
                                        <th>Ultima Atualização do perfil</th>
                                        <th>Data de criação</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
         
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@stop

@section('css')

@stop

@section('js')
    <script>
        // Dados do gráfico de exemplo
        const data = {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Pedidos',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                data: {!! json_encode($valores) !!},
            }]
        };

        // Configurações do gráfico
        const options = {
            responsive: true,
            maintainAspectRatio: false,
        };

        // Criar o gráfico no elemento canvas
        const ctx = document.getElementById('salesChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Tipo do gráfico (neste exemplo, utilizamos um gráfico de barras)
            data: data,
            options: options
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
