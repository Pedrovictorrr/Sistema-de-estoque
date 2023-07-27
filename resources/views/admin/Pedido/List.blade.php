@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div>
        <h1 class="text-center">Pedidos</h1>
    </div>



@stop

@section('content')
    <div class="container">
        <div class="p-3 shadow rounded border bg-white">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Quantidade de itens</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <th scope="row">{{$pedido->id}}</th>
                            <td>{{ $pedido->user->name}}</td>
                            <td>{{ $pedido->Qtd_itens}}</td>
                            <td>R${{ $pedido->Valor_total}}</td>
                            <td><a target="_blank" href="{{route('pdf.pedido',['id' => $pedido->id])}}" class="btn btn-primary">PDF</a target="_blank"></td>
                        </tr>
                    @endforeach
                    {{ $pedidos->links() }}
                        
                </tbody>
            </table>
            
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
