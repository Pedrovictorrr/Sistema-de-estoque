@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1 class="text-center">Produtos</h1>
    </div>

@stop

@section('content')
    <div class="container-xxl d-flex justify-content-center ">
        <div class=" p-3 col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabela de produtos</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="rounded">
                            <tr class="text-center">
                                <th scope="col-2">Foto</th>
                                <th scope="col-2">Codigo</th>
                                <th scope="col-2">Produto</th>
                                <th scope="col-2">Categoria</th>
                                <th scope="col-1">Quantidade</th>
                                <th scope="col-1">Valor</th>
                                <th scope="col">Valor em estoque</th>
                                <th scope="col-1">Ultima atualização</th>
                                <th scope="col-1">Ação</th>
                            </tr>
                        </thead>
                        <tbody id="produtoInfo" class="overflow-auto">
                            @foreach ($produtos as $produto)
                                <tr data-product-id="{{ $produto->id }}" class="text-center">
                                    <td><img src="{{ $produto->foto }}" alt="" height="50px" width="50px"
                                            srcset="">
                                    <th scope="row">{{ $produto->id }}</th>
                                    </td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->categoria->NomeCategoria }}</td>
                                    <td>{{ $produto->Qtd_Produtos }}</td>
                                    <td>R$ {{ number_format( $produto->preco, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($produto->Qtd_Produtos * $produto->preco, 2, ',', '.') }}</td>
                                    <td>{{ $produto->updated_at }}</td>
                                    <td class="">

                                        <button class="btn btn-primary btn-editar"
                                            onclick="openModalWithProduct({{ json_encode($produto) }})">Editar</button>


                                        <button class="btn btn-danger"
                                            onclick="openConfirmationModal({{ json_encode($produto->id) }})">Excluir</button>



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
                <button class="btn btn-success"> Excel</button>
                <button class="btn btn-danger"> PDF</button>
            </div>
            <div class="d-flex justify-content-end col-6">
                <a href="{{ $produtos->previousPageUrl() }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" style="fill: white" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </a>

                <!-- a Tag for next page -->
                <a href="{{ $produtos->nextPageUrl() }}" class="btn btn-primary">
                    <svg style="fill: white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                    </svg>
                </a>
            </div>
        </div>  
        </div>
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
