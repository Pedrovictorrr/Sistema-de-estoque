@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div>
        <h1 class="text-center">Pedidos</h1>
    </div>



@stop

@section('content')
    <div class="container-xxl">
        <div class="p-3 col-sm-12 shadow rounded border bg-white mb-2 ">
            <div class="card-header row">
                <div class="col-md-6 p-2 mt-1">
                    <h3 class="card-title">Tabela de pedidos</h3>
                </div>

                <div class="mb-3 mt-1 col-md-6">
                    <input type="text" class="form-control" id="searchInput"
                        placeholder="Buscar por nome do remetente, destinatario ou codigo do pedido">

                </div>
            </div>
            <div class="table-container">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Cod.</th>
                            <th scope="col">Remetente</th>
                            <th scope="col">Destinatario</th>
                            <th scope="col">Qtd. itens</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Data de criação</th>
                            <th scope="col">Documento</th>
                        </tr>
                    </thead>
                    <tbody id="produtoInfo" class="overflow-auto produto-list mb-2">
                        @foreach ($pedidos as $pedido)
                            <tr class="text-center product-row">
                                <td scope="row"><strong>{{ $pedido->id }}</strong></td>
                                <td>{{ $pedido->user->name }}</td>
                                <td>{{ $pedido->destinatario->name }}</td>
                                <td>{{ $pedido->Qtd_itens }}</td>
                                <td>R$ {{ number_format($pedido->Valor_total, 2, ',', '.') }}</td>
                                <td>{{ $pedido->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <a target="_blank" href="{{ route('pdf.pedido', ['id' => $pedido->id]) }}"
                                        class="btn btn-danger">PDF</a target="_blank">
                                    <button class="btn btn-primary ver-button" data-toggle="modal"
                                        data-target="#modalInfo">Ver</button>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>


        </div>
        <div class="p-2">
            <div class="p-3 bg-white border  rounded shadow row">
                <div class="col-6">
                    <strong>Donwload da planilha: </strong>
                    <a href="{{ route('downloadListExcel.Pedidos') }}" target="_blank" class="btn btn-success"> Excel</a>
                    
                </div>
             
            </div>
        </div>

    </div>
    <!-- a Tag for previous page -->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInfoLabel">Pedido Nº<span id="modalOrderId"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Here, you can display the information of the selected pedido -->
                    <p><strong>Order ID:</strong> <span id="modalId"></span></p>
                    <p><strong>User Name:</strong> <span id="modalUserName"></span></p>
                    <p><strong>Destinatario Name:</strong> <span id="modalDestinatarioName"></span></p>
                    <p><strong>Quantidade de itens:</strong> <span id="modalQTD"></span></p>
                    <p><strong>Valor total:</strong> <span id="modalValorTotal"></span></p>
                    <p><strong>Data do pedido:</strong> <span id="modaldataCriacao"></span></p>
                    <!-- Add more fields here if needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <style>
        /* Estilos anteriores (mantidos para referência) */

        /* ... */

        /* Estilizando os botões "Next" e "Back" */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin-right: 5px;
        }

        .pagination li a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #f57c00;
            color: #fff;
            border-radius: 3px;
        }

        .pagination li a:hover {
            background-color: #e65100;
        }

        .pagination .active a {
            background-color: #1a237e;
        }

        /* Estilizando os botões "Next" e "Back" */
        .pagination .pagination-prev a,
        .pagination .pagination-next a {
            background-color: #5e35b1;
        }

        .pagination .pagination-prev a:hover,
        .pagination .pagination-next a:hover {
            background-color: #4527a0;
        }
    </style>
    <style>
        .table-container {
            padding: 20px;
            max-height: 600px;
            /* Defina a altura máxima que desejar */
            overflow-y: auto;
            /* Adiciona um scroll vertical quando necessário */
        }
    </style>
@stop

@section('js')
<script src="js/listar-pedidos.js"></script>
    <script>
      
    </script>
@stop
