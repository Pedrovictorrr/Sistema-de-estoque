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

            <p><strong>Pedido feito por:</strong> {{ $user->name }}<br>
                <strong>Email:</strong> {{ $user->email }}<br>
                <strong>Criado em:</strong> {{ $pedido->created_at }}<br>
                <strong>Hash do usuario:</strong> {{ $hash }}<br>
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
                            <td>R${{($item->produto->preco) }}</td>
                            <td>R${{ (float) ($item->produto->preco * $item->Qtd_produtos) }}.00</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td ></td>
                        <td class="border"><strong>Total:</strong> R${{ $pedido->Valor_total }}</td>
                    </tr>


                </tbody>
            </table>
           
            <div class="p-3">
                <a target="_blank" href="{{route('pdf.pedido',['id' => $pedido->id])}}" class="btn btn-primary">Gerar pdf / Imprimir</a target="_blank">
                <button class="btn btn-success">Ver todos os pedidos</button>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
