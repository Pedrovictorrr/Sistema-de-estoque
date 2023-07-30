@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1 class="text-center">Categorias</h1>
    </div>

@stop

@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="p-3 col-md-5  ">
                <div class="p-3 shadow rounded border bg-white mb-2 h-100">
                    <div class="h-100">
                        <div class="text-center">
                            <h5>Criar nova categoria</h5>
                        </div>
                        <form id="NovaCategoria">
                            <input type="hidden" id="csrfToken" name="_token" value="{{ csrf_token() }}">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome da categoria:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nome da categoria">
                            </div>
                            <div class="form-group">

                                <label for="exampleFormControlSelect2">Adicionar produtos a categoria:</label>
                               
                                <div class="">
                                    <ul class="list-group list-group-flush table-container1 border">
                                    
                                        @if (count($produtos) > 0)
                                        @foreach ($produtos as $produto)
                                            @if ($produto->nome && $produto->categoria && $produto->categoria->NomeCategoria)
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $produto->id }}" value="{{ $produto->id }}">
                                                        <label class="form-check-label" for="inlineCheckbox{{ $produto->id }}">{{ $produto->id }} - {{ $produto->nome }} - [{{ $produto->categoria->NomeCategoria }}]</label>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $produto->id }}" value="{{ $produto->id }}" disabled>
                                                        <label class="form-check-label" for="inlineCheckbox{{ $produto->id }}">Não existe</label>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li class="list-group-item">
                                            Nenhum produto encontrado.
                                        </li>
                                    @endif
                                    
                                    
                           
                                    
                                    
                                    
                                    </ul>
                                </div>
                            </div>
                            <div class="p-3">
                                <button type="button" id="submitButton" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-3 col-md-7  ">
                <div class="p-3 shadow rounded border bg-white mb-2">
                    <div class="card-header row">
                        <div class="col-md-6 p-2 mt-1">
                            <h3 class="card-title">Tabela de categorias</h3>
                        </div>

                        <div class="mb-3 mt-1 col-md-6">
                            

                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Cod.</th>
                                    <th scope="col">Nome da categoria</th>
                                    <th scope="col">Quantidade de produtos</th>
                                    <th scope="col">Ticket médio</th>

                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody id="produtoInfo" class="overflow-auto produto-list mb-2">
                                @foreach ($categorias as $categoria)
                                    <tr class="text-center">
                                        <td scope="col">{{ $categoria->id }}</td>
                                        <td scope="col">{{ $categoria->NomeCategoria }}</td>
                                        <td scope="col">{{ $categoria->produtos->count() }}</td>
                                        <td scope="col">
                                            @if ($categoria->produtos->count() > 0)
                                                R${{ number_format($categoria->produtos->sum('preco') / $categoria->produtos->count(), 2, ',', '') }}
                                            @else
                                                R$ 0
                                                <!-- Ou qualquer mensagem que você queira exibir quando não houver produtos -->
                                            @endif
                                        </td>
                                        <th class="">
                                            <button class="btn btn-primary open-modal"
                                                data-id="{{ $categoria->id }}" data-nome="{{ $categoria->NomeCategoria }}"
                                                data-num-produtos="{{ $categoria->produtos->count() }}"
                                                data-preco-medio=" @if ($categoria->produtos->count() > 0) {{ number_format($categoria->produtos->sum('preco') / $categoria->produtos->count(), 2, ',', '') }}
                                        @else
                                            0
                                            <!-- Ou qualquer mensagem que você queira exibir quando não houver produtos --> @endif">Editar</button>
                                            <button class="btn btn-danger btn-excluir" data-id="{{ $categoria->id }}">Excluir</button>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmationModal" class="modal-confirm">
        <div class="modal-content2">
            <h2>Confirmar envio do formulário</h2>
            <p>Tem certeza de que deseja enviar o formulário?</p>
            <div class="modal-buttons2">
                <button id="confirmButton" class="btn btn-primary">Confirmar</button>
                <button id="cancelButton" class="btn btn-danger">Cancelar</button>
            </div>
        </div>
    </div>
    <div id="mensagemExclusao" class="alert alert-success" style="display: none;">
        Item excluído com sucesso!
    </div>
    <!-- Modal para exibir informações da categoria -->
    <div class="modal fade bd-example-modal-lg"  id="categoriaModal" tabindex="-1" aria-labelledby="myLargeModalLabel" role="dialog"  style="margin-top: 50px!important;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes da Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editarCategoria">

                        <div class="modal-body">
                            <!-- Label e input para Categoria ID -->
                            <div class="form-group">
                                <label for="inputCategoriaId">Categoria ID:</label>
                                <input type="text" name="CategoriaId" class="form-control" id="inputCategoriaId" disabled/>
                                <input type="hidden" name="CategoriaId" value="" class="form-control" id="inputCategoriaIdPost" />
                            </div>
                        
                            <!-- Label e input para Categoria Nome -->
                            <div class="form-group">
                                <label for="inputCategoriaNome">Categoria Nome:</label>
                                <input type="text" name="NomeCategoria" class="form-control" id="inputCategoriaNome" />
                            </div>
                            <label for="exampleFormControlSelect2">Adicionar produtos a categoria:</label>
                            <ul class="list-group list-group-flush table-container1 border">
                                @if (count($produtos) > 0)
                                @foreach ($produtos as $produto)
                                    @if ($produto->nome && $produto->categoria && $produto->categoria->NomeCategoria)
                                        <li class="list-group-item">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $produto->id }}" value="{{ $produto->id }}">
                                                <label class="form-check-label" for="inlineCheckbox{{ $produto->id }}">{{ $produto->id }} - {{ $produto->nome }} - [{{ $produto->categoria->NomeCategoria }}]</label>
                                            </div>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $produto->id }}" value="{{ $produto->id }}" disabled>
                                                <label class="form-check-label" for="inlineCheckbox{{ $produto->id }}">Não existe</label>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                <li class="list-group-item">
                                    Nenhum produto encontrado.
                                </li>
                            @endif
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" id="submitButtonEdit">Editar</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <strong><h4>Tem certeza que deseja excluir esta categoria?</h4> </strong>
                </div>
                <p class="p-3"><strong>Obs:</strong> Você vai excluir todos os produtos que estão nessa categoria se realizar essa ação!</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmExcluir">Excluir</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .table-container1 {
            padding: 20px;
            max-height: 300px;
            /* Defina a altura máxima que desejar */
            overflow-y: auto;
            /* Adiciona um scroll vertical quando necessário */
        }
    </style>
    <style>
        .table-container {
            padding: 20px;
            max-height: 500px;
            /* Defina a altura máxima que desejar */
            overflow-y: auto;
            /* Adiciona um scroll vertical quando necessário */
        }
    </style>
    <style>
        /* Modal styles */
        .modal-confirm {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Black with opacity */
        }

        .modal-content2 {
            background-color: #fff;
            max-width: 600px;
            margin: 250px auto;
            /* Center modal on screen */
            padding: 20px;
            border-radius: 5px;
        }

        .modal-buttons2 {
            text-align: right;
            margin-top: 20px;
        }

        .modal-buttons button {
            margin-left: 10px;
        }

        /* Success message card styles */
        .card {
            display: none;
            background-color: #dff0d8;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        /* Utility class to hide elements */
        .hidden {
            display: none;
        }

        .successCard.card {
            display: none;
            background-color: #dff0d8;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
        }

        .successCard h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }



        /* Estilos para o modal personalizado */


        /* Estilos para os botões */
    </style>


@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/Categorias.js"></script>
@stop
