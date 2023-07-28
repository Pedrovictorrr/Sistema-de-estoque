@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div>
        <h1 class="text-center">Pedidos</h1>
    </div>



@stop

@section('content')
    <div class="container-xxl">
        <div class="p-3 col-sm-12 shadow rounded border bg-white mb-2">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Qtd. itens</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Data de criação</th>
                        <th scope="col">Documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr class="text-center">
                            <th scope="row">{{ $pedido->id }}</th>
                            <td>{{ $pedido->user->name }}</td>
                            <td>{{ $pedido->user->email }}</td>
                            <td>{{ $pedido->Qtd_itens }}</td>
                            <td>R$ {{ number_format( $pedido->Valor_total, 2, ',', '.') }}</td>
                            <td>{{ $pedido->created_at }}</td>
                            <td>
                                <a target="_blank" href="{{ route('pdf.pedido', ['id' => $pedido->id]) }}"
                                    class="btn btn-danger">PDF</a target="_blank">
                                    <button class="btn btn-primary">Ver</button>
                                </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        <div class="p-2">
                <div class="p-3 bg-white border  rounded shadow row">
            <div class="col-6">
                <strong>Donwload da planilha: </strong>
                <button class="btn btn-success"> Excel</button>
                <button class="btn btn-danger"> PDF</button>
            </div>
            <div class="d-flex justify-content-end col-6">
                <a href="{{ $pedidos->previousPageUrl() }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" style="fill: white" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </a>

                <!-- a Tag for next page -->
                <a href="{{ $pedidos->nextPageUrl() }}" class="btn btn-primary">
                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                    </svg>
                </a>
            </div>
        </div>  
        </div>
  
    </div>
    <!-- a Tag for previous page -->

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
@stop

@section('js')

@stop
