@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div>
        <h1 class="text-center">Fazer Pedido</h1>
    </div>


@stop

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <div class="container-xxl d-flex justify-content-center">
        <div class="col-md-12 p-5 border bg-white rounded shadow">
            <div class="input-group col-md-6 p-3">
                <input type="hidden" id="csrfToken" name="_token" value="{{ csrf_token() }}">
                <select class="custom-select col-md-10" id="inputGroupSelect04"
                    aria-label="Example select with button addon" onchange="updateMaxValue()">
                    <option>Selecione um produto</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->id }} - {{ $produto->nome }}</option>
                    @endforeach
                </select>
                <select id="quantidadeSelect" class="form-control col-md-4">
                    <!-- Placeholder option -->
                    <option value="" disabled selected>Quantidade máxima</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="adicionarProduto()">Adicionar</button>
                </div>
            </div>
            <div class="form-group p-3 col-md-6">
                <label for="Destinatario">Destinatario</label>
                <select name="Destinatario" id="Destinatario" class="form-control" id="Destinatario">
                    @foreach ($users as $user )
                        <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option> 
                    @endforeach
                 
            
                </select>
              </div>


            <div class="p-3 ">
                <table id="produtoTable" class="table table-bordered ">
                    <thead>
                        <tr class="text-center">
                            <th scope="col-2">Codigo</th>
                            <th scope="col-2">Foto</th>
                            <th scope="col-2">Produto</th>
                            <th scope="col-2">Categoria</th>
                            <th scope="col-1">Quantidade</th>
                            <th scope="col-1">Valor</th>
                            <th scope="col-3">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <td>+</td>
                            <td>+</td>
                            <td>+</td>
                            <td>+</td>
                            <td>+</td>
                            <td>+</td>
                            <td>+</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="produtoModalLabel">Detalhes do Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aqui vamos exibir as informações do produto -->
                        <div class="table-container">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col-2">Codigo</th>
                                        <th scope="col-2">Foto</th>
                                        <th scope="col-2">Produto</th>
                                        <th scope="col-2">Categoria</th>
                                        <th scope="col-1">Quantidade</th>
                                        <th scope="col-1">Valor</th>
                                        <th scope="col-1">Destinatario</th>
                                    </tr>
                                </thead>
                                <tbody id="produtoInfo" class="overflow-auto">


                                </tbody>
                            </table>
                        </div>
                        <div>
                            <form action="{{ route('enviar.pedido') }}" method="post">
                                @csrf
                                <div id="produtosArrayInput"></div>
                                <button class="btn btn-primary">Enviar</button>
                                <button type="button" onclick="closeModal()" class="btn btn-danger">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <div class="p-1">
                    <button type="button" class="btn btn-primary" id="openModalBtn">
                        Enviar pedido
                    </button>
                </div>
              

            </div>
            <div class="border bg-light p-3 mt-2 rounded">
                <h5><strong>Obs.: Selecione o produto e adicione a lista.</strong></h5>
            </div>
        </div>
        

    </div>
   
@stop

@section('css')
<style>
    .table-container {
        padding: 20px;
        max-height: 600px;
        /* Defina a altura máxima que desejar */
        overflow-y: auto;
        /* Adiciona um scroll vertical quando necessário */
    }
</style>
    <style>
        /* Estilização do modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 60%;
            height: 100%;
            padding-inline: 60px;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;

        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/pedido.js"></script>
@stop
