@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1 class="text-center">Produtos</h1>
    </div>

@stop

@section('content')
    <div class="container-xxl d-flex justify-content-center ">
        <div class=" p-3 col-md-8 rounded shadow bg-white">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col-2">Codigo</th>
                        <th scope="col-2">Foto</th>
                        <th scope="col-2">Produto</th>
                        <th scope="col-2">Categoria</th>
                        <th scope="col-1">Quantidade</th>
                        <th scope="col-1">Valor</th>
                        <th scope="col-1">Ação</th>
                    </tr>
                </thead>
                <tbody id="produtoInfo" class="overflow-auto">
                    @foreach ($produtos as $produto)
                        <tr data-product-id="{{ $produto->id }}" class="text-center">
                            <th scope="row">{{ $produto->id }}</th>
                            <td><img src="{{ $produto->foto }}" alt="" height="50px" width="50px" srcset="">
                            </td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->categoria->NomeCategoria }}</td>
                            <td>{{ $produto->Qtd_Produtos }}</td>
                            <td>R${{ $produto->preco }}</td>
                            <td class="d-flex justify-content-center">
                                <div class="p-1">
                                    <button class="btn btn-primary btn-editar"
                                        onclick="openModalWithProduct({{ json_encode($produto) }})">Editar</button>
                                </div>
                                <div class="p-1">
                                    <button class="btn btn-danger"
                                        onclick="openConfirmationModal({{ json_encode($produto->id) }})">Excluir</button>
                                </div>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Adicione o seguinte elemento <div> após a tabela -->
            <div id="mensagemExclusao" class="alert alert-success" style="display: none;">
                Item excluído com sucesso!
            </div>
            <div id="tabelaVazia" class="alert alert-info" style="display: none;">
                A tabela está vazia.
            </div>

        </div>
    </div>

    {{-- Modal --}}
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="modalContentPlaceholder">
                        <!-- O conteúdo do produto será carregado aqui -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal confirm --}}
    <!-- Modal de confirmação -->
    <!-- Modal de confirmação -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="csrfToken" name="_token" value="{{ csrf_token() }}">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmação de exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="confirmationModalBody">
                    Tem certeza de que deseja excluir este item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Excluir</button>
                </div>
            </div>
        </div>
    </div>



@stop

@section('css')

    <style>
        /* Estilo para o modal */
        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #modal-content {
            background-color: white;

            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/listar-produtos.js"></script>
@stop
