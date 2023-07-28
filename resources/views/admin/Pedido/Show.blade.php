@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div>
        <h1 class="text-center">Pedido Nº{{ $pedido->id }}</h1>
    </div>



@stop

@section('content')
    <div class="container">
        <div class=" border shadow bg-white p-3">
            <h4>Detalhes do pedido:</h4>

            <p><strong>Remetente:</strong> {{ $pedido->user->name }}<br>
                <strong>Email:</strong> {{ $pedido->user->email }}<br>
                <strong>Criado em:</strong> {{ $pedido->created_at->format('d/m/Y H:i:s') }}<br>
                <strong>Hash do usuario:</strong> {{ $hashRemetente }}<br>
            </p>

            <p><strong>Destinatario:</strong> {{ $pedido->destinatario->name }}<br>
                <strong>Email:</strong> {{ $pedido->destinatario->email }}<br>
                <strong>Criado em:</strong> {{ $pedido->created_at->format('d/m/Y H:i:s') }}<br>
                <strong>Hash do usuario:</strong> {{ $hashDestinatario }}<br>
            </p>
            <h4>Produtos:</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Valor por item</th>
                        <th scope="col">Valor total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itens as $item)
                        <tr>
                            <th scope="row">{{$item->produto->id}}</th>
                            <td>{{$item->produto->nome}}</td>
                            <td>{{$item->Qtd_produtos}}</td>
                            <td>R$ {{ number_format($item->produto->preco, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($item->Qtd_produtos * $item->produto->preco, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td ></td>
                        <td class="border"><strong>Total:</strong> R${{ number_format($pedido->Valor_total, 2, ',', '.') }}</td>
                    </tr>


                </tbody>
            </table>
           
            <div class="p-3">
                <a target="_blank" href="{{route('pdf.pedido',['id' => $pedido->id])}}" class="btn btn-primary">Gerar pdf / Imprimir</a target="_blank">
                <a href="{{route('listar.pedidos')}}" class="btn btn-success">Ver todos os pedidos</a href="{{route('pdf.pedido',['id' => $pedido->id])}}">
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
