@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h1 class="text-center">Inserir produto</h1>
    </div>

@stop

@section('content')
    <div class="container-xxl d-flex justify-content-center">
        <div class="col-md-12 p-5 border bg-white rounded shadow">
            <form action="{{ route('enviar.produto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="NomeDoProduto">Nome do produto (*)</label>
                            <input name="NomeDoProduto" required type="text" placeholder="Produto Exemplo..." class="form-control"
                                id="NomeDoProduto" placeholder="">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mt-2">
                                <div class="form-check form-check-inline">
                                    <input  class="form-check-input" type="radio" name="categoria"
                                        id="inlineRadio1" value="Existente" checked>
                                    <label class="form-check-label" for="inlineRadio1">Usar categoria existente: </label>
                                </div>
                                <select required name="categoriaID" class="form-control" id="exampleFormControlSelect2" disabled>
                                    @foreach ($categorias as $categoria )
                                    <option value="{{$categoria->id}}">{{$categoria->NomeCategoria}}</option>
                                    @endforeach
                              
                                </select>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-check form-check-inline">
                                    <input  class="form-check-input" type="radio" name="categoria"
                                        id="inlineRadio2" value="Criar">
                                    <label class="form-check-label" for="inlineRadio2">Criar categoria: (*)</label>
                                </div>
                                <input name="NomeCategoria" required type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Nome da categoria" disabled>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="ValorDoProduto">Valor: (*)</label>
                                <input name="Valor" type="text" placeholder="00.00" class="form-control col-sm-6" 
                                id="ValorDoProduto" pattern="^\d+(\.\d{1,2})?$" 
                                title="Digite um valor válido (por exemplo, 10 ou 10.00)" 
                                required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="QuantidadeDoProduto">Quantidade: (*)</label>
                                <input name="Quantidade" required type="number" placeholder="00" class="form-control col-sm-6"
                                    id="QuantidadeDoProduto" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="DescricaoDoProduto">Descrição: (opcional)</label>
                            <textarea name="Descricao" class="form-control" id="DescricaoDoProduto" placeholder="Sua descrição aqui..." rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Validade" id="exampleRadios1"
                                value="SemValidade" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Sem validade.
                            </label>
                        </div>
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="radio" name="Validade" id="exampleRadios2"
                                value="ComValidade">
                                <label class="form-check-label" for="exampleRadios2">
                                    Data de validade:
                                </label>
                                <input name="DataValidade" required type="date" class="form-control col-sm-3" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                        </div>

                    </div>
                    <div class="col-sm-6 mt-2 mb-3 d-flex justify-content-center">

                        <div class="mb-2">
                            <!-- Hidden file input -->
                            <input id="img-input" type="file" name="imagem" accept=".jpg, .jpeg, .png" style="display: none;">
                            <!-- Label for the file input -->
                            <label for="img-input" style="cursor: pointer;" class="text-center">
                                <label for="DescricaoDoProduto">Foto do produto: (opcional)</label>
                                <div class="p-3 rounded-lg border" style="height: 500px; width: 100%;">
                                    <img id="preview" src="/img/add-img.png" style="height: 100%; width: 100%;">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <div class="p-1">
                            <button type="button" class="btn-primary btn">
                                Enviar produto
                            </button>
                        </div>
                        

                    </div>
                </div>

                <!-- Modal -->
                <div class="modal" id="infoModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Informações do Produto</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nome do produto:</strong> <span id="infoNomeProduto"></span></p>
                                <p><strong>Categoria:</strong> <span id="infoCategoria"></span></p>
                                <p><strong>Valor:</strong> <span id="infoValor"></span></p>
                                <p><strong>Quantidade:</strong> <span id="infoQuantidade"></span></p>
                                <p><strong>Descrição:</strong> <span id="infoDescricao"></span></p>
                                <p><strong>Validade:</strong> <span id="infoValidade"></span></p>
                                <p><strong>Imagem:</strong></p>
                                <img id="infoImagem" src="" style="max-height: 200px; max-width: 200px;" />
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
         // Get the file input element
    var imgInput = document.getElementById('img-input');

// Add an event listener to the file input to check the file size
imgInput.addEventListener('change', function() {
    var fileSize = this.files[0].size; // Size of the selected file in bytes

    // Convert file size to MB
    var fileSizeMB = fileSize / (1024 * 1024);

    // Check if the file size exceeds 5MB
    if (fileSizeMB > 5) {
        // Display an error message
        alert('A imagem não pode ter mais de 5MB.');
        // Clear the file input
        this.value = '';
    } else {
        // File size is within the limit, you can display a preview of the image if needed
        var preview = document.getElementById('preview');
        var fileReader = new FileReader();
        fileReader.onload = function() {
            preview.src = fileReader.result;
        };
        fileReader.readAsDataURL(this.files[0]);
    }
});
        $(document).ready(function() {
    // Get the input element
    var dataValidadeInput = $('#exampleInputEmail1');

    // Attach an event listener to the input element to check for changes
    dataValidadeInput.on('change', function() {
        // Get the selected date from the input
        var selectedDate = new Date($(this).val());

        // Get the current date
        var currentDate = new Date();

        // Set the time of the current date to midnight to ignore the time part
        currentDate.setHours(0, 0, 0, 0);

        // Compare the selected date with the current date
        if (selectedDate < currentDate) {
            // If the selected date is earlier than the current date, display an error message
            alert('A data de validade não pode ser menor que o dia atual.');
            // You can also clear the input to prevent submission of an invalid date
            $(this).val('');
        }
    });
});
        // Preview da imagem // 
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("preview").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }
        document.getElementById("img-input").addEventListener("change", readImage, false);




        // habilitar checkbox // 

        document.addEventListener('DOMContentLoaded', function() {
            const radioSemValidade = document.getElementById('exampleRadios1');
            const radioDataValidade = document.getElementById('exampleRadios2');
            const inputValidade = document.getElementById('exampleInputEmail1');

            // Função para habilitar ou desabilitar o input de acordo com a seleção do radio button
            function toggleInputValidade() {
                inputValidade.disabled = !radioDataValidade.checked;
            }

            // Chama a função para definir o estado inicial do input de acordo com a seleção inicial
            toggleInputValidade();

            // Adiciona um listener para o evento de mudança de seleção dos radio buttons
            radioSemValidade.addEventListener('change', toggleInputValidade);
            radioDataValidade.addEventListener('change', toggleInputValidade);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const radioUsarCategoriaExistente = document.getElementById('inlineRadio1');
            const radioCriarCategoria = document.getElementById('inlineRadio2');
            const selectCategoriaExistente = document.getElementById('exampleFormControlSelect2');
            const inputNomeCategoria = document.getElementById('exampleFormControlInput1');

            // Função para habilitar ou desabilitar os campos de acordo com a seleção do radio button
            function toggleCamposCategoria() {
                selectCategoriaExistente.disabled = !radioUsarCategoriaExistente.checked;
                inputNomeCategoria.disabled = !radioCriarCategoria.checked;
            }

            // Chama a função para definir o estado inicial dos campos de acordo com a seleção inicial
            toggleCamposCategoria();

            // Adiciona um listener para o evento de mudança de seleção dos radio buttons
            radioUsarCategoriaExistente.addEventListener('change', toggleCamposCategoria);
            radioCriarCategoria.addEventListener('change', toggleCamposCategoria);
        });


        // modal content // 
        document.addEventListener('DOMContentLoaded', function() {
            const enviarProdutoBtn = document.querySelector('.btn-primary');
            const selectCategoriaExistente = document.getElementById('exampleFormControlSelect2');
            const inputNomeCategoria = document.getElementById('exampleFormControlInput1');
            const inputNomeProduto = document.getElementById('NomeDoProduto');
            const inputValorProduto = document.getElementById('ValorDoProduto');
            const inputQuantidadeProduto = document.getElementById('QuantidadeDoProduto');
            const inputDescricaoProduto = document.getElementById('DescricaoDoProduto');
            const inputValidade = document.getElementById('exampleInputEmail1');
            const radioUsarCategoriaExistente = document.getElementById('inlineRadio1');
            const radioDataValidade = document.getElementById('exampleRadios2');
            const inputImagem = document.getElementById('img-input');
            const imgPreview = document.getElementById('preview');
            const infoModal = document.getElementById('infoModal');
            const infoNomeProduto = document.getElementById('infoNomeProduto');
            const infoCategoria = document.getElementById('infoCategoria');
            const infoValor = document.getElementById('infoValor');
            const infoQuantidade = document.getElementById('infoQuantidade');
            const infoDescricao = document.getElementById('infoDescricao');
            const infoValidade = document.getElementById('infoValidade');
            const infoImagem = document.getElementById('infoImagem');

            // Função de validação do formulário
            function validarFormulario() {
                // Verifica se todos os campos obrigatórios foram preenchidos
                if (inputNomeProduto.value === "" ||
                    (radioUsarCategoriaExistente.checked && selectCategoriaExistente.value === "") ||
                    (radioDataValidade.checked && inputValidade.value === "") ||
                    inputValorProduto.value === "" ||
                    inputQuantidadeProduto.value === "") {
                    alert("Por favor, preencha todos os campos obrigatórios antes de enviar o produto.");
                    return false;
                }

                // Se a validação passou, abrir o modal
                abrirModalComInformacoes();
                return true;
            }

            // Função para abrir o modal com as informações dos inputs
            function abrirModalComInformacoes() {
                infoNomeProduto.textContent = inputNomeProduto.value;
                infoCategoria.textContent = radioUsarCategoriaExistente.checked ? selectCategoriaExistente.value :
                    inputNomeCategoria.value;
                infoValor.textContent = inputValorProduto.value;
                infoQuantidade.textContent = inputQuantidadeProduto.value;
                infoDescricao.textContent = inputDescricaoProduto.value ? inputValidade.value : 'Sem Descrição';
                infoValidade.textContent = radioDataValidade.checked ? inputValidade.value : 'Sem validade';
                const file = inputImagem.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function() {
                        infoImagem.src = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                $('#infoModal').modal('show'); // Utilizando jQuery para abrir o modal
            }

            // Adiciona um listener para o evento de clique do botão "Enviar produto"
            enviarProdutoBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Impede o envio do formulário por padrão
                validarFormulario();
            });

            // Adiciona um listener para o evento de mudança da imagem selecionada
            inputImagem.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function() {
                        imgPreview.src = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@stop
