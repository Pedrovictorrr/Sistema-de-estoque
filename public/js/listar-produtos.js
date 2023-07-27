
    // Função para abrir o modal e preencher com as informações do produto
    function openModalWithProduct(product) {
        // Defina o título do modal
        var modalTitle = "Editar Produto";
        document.getElementById("modalTitle").innerHTML = modalTitle;
        if (!product.foto) {
            product.foto = "/img/add-img.png";
        }
        // Preencha o conteúdo do modal com as informações do produto
        var modalContent = `
  <form id="productForm">
    @csrf
    <input type="hidden" name="id" value="${product.id}">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="modal-nome">Produto:</label>
          <input type="text" value="${product.nome}" placeholder="${product.nome}" id="modal-nome" name="nome" class="form-control" >
        </div>
        <div class="form-group">
          <label for="modal-categoria">Categoria:</label>
          <input type="text" value="${product.categoria.NomeCategoria}" placeholder="${product.categoria.NomeCategoria}" id="modal-categoria" name="categoria" class="form-control" >
        </div>
        <div class="form-group">
          <label for="modal-qtd">Quantidade:</label>
          <input type="number" value="${product.Qtd_Produtos}" placeholder="${product.Qtd_Produtos}" id="modal-qtd" name="qtd" class="form-control">
        </div>
        <div class="form-group">
          <label for="modal-preco">Valor:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">R$</span>
            </div>
            <input type="text" value="${product.preco}" placeholder="${product.preco}" id="modal-preco" name="preco" class="form-control" >
          </div>
        </div>
        <div class="form-group">
          <label for="DescricaoDoProduto">Descrição: (opcional)</label>
          <textarea value="${product.descricao}" placeholder="${product.descricao}" name="Descricao" class="form-control" id="DescricaoDoProduto"  rows="3"></textarea>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="mb-2">
          <!-- Hidden file input -->
          <input  id="img-input" type="file" name="imagem" accept=".jpg, .jpeg, .png" style="display: none;">
          <!-- Label for the file input -->
          <label for="img-input" style="cursor: pointer;" class="text-center">
            <!-- Image that serves as a button -->
            <label for="DescricaoDoProduto">Foto do produto: (opcional)</label>
            <div class="p-3 rounded-lg border" style="height: 100%; width: 100%;">
              <img id="preview" src="${product.foto}" style="height: 100%; width: 100%;">
            </div>
          </label>
        </div>
      </div>
    </div>
    <!-- Add other fields here if needed --> 
    <button type="button" class="btn btn-primary" onclick="submitForm()">Salvar</button>

    <button type="button" class="btn btn-danger" onclick="closeModal()">Fechar</button>
   
  </form>
`;

        // Insira o conteúdo do formulário no modal
        document.getElementById("modalContentPlaceholder").innerHTML = modalContent;
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

        // Abra o modal
        $("#myModal").modal("show");
    }

    // Função para fechar o modal
    function closeModal() {
        $("#myModal").modal("hide");
    }


    function submitForm() {
        // Serialize form data
        const formData = $("#productForm").serialize();

        // Make the AJAX request
        $.ajax({
            type: "POST",
            url: "/editProduct", // Replace with the actual URL
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content') // Assuming you have a CSRF token meta tag
            },
            success: function(response) {
                // Handle success
                // For example, display a success message or update the page content
                console.log("Form submitted successfully!");
            },
            error: function(error) {
                // Handle errors
                // For example, display an error message
                console.error("Error:", error);
            }
        });
    }



var productIdToDelete;
    function showSuccessMessage(message) {
        var mensagemExclusaoElement = $('#mensagemExclusao');
        mensagemExclusaoElement.text(message);
        mensagemExclusaoElement.show();
        setTimeout(function() {
            mensagemExclusaoElement.hide();
        }, 3000); // A mensagem será ocultada após 3 segundos (pode ajustar esse valor conforme necessário).
    }

    function openConfirmationModal(productId) {
        // Atualiza o valor da variável global productIdToDelete com o ID do produto atual.
        productIdToDelete = productId;
        // Atualiza o data-product-id do botão "Excluir" com o ID do produto atual.
        $('#confirmDelete').attr('data-product-id', productIdToDelete);
        $('#confirmationModal').modal('show');
    }

    

    function deleteItem(id) {
        var csrfToken
        csrfToken = document.getElementById("csrfToken").value;
        console.log(csrfToken)
        // Aqui você pode implementar a lógica para enviar a solicitação AJAX para excluir o item pelo ID.
        // Por exemplo, usando o jQuery para realizar a solicitação.
        $.ajax({
            method: 'POST',
            url: '/delete-produto',
            data: {
                _token: csrfToken,
                id: id
            },
            success: function(response) {
                // Lidar com a resposta do servidor após a exclusão, se necessário.
                showSuccessMessage('Item excluído com sucesso!');
                // Remove a linha da tabela correspondente ao produto excluído.
                $('tr[data-product-id="' + id + '"]').remove();
                checkTableIsEmpty();

            },
            error: function(error) {
                // Lidar com possíveis erros de exclusão.
                console.error('Ocorreu um erro ao excluir o item:', error);
            }
        });
    } // Evento acionado após o modal de confirmação ser completamente exibido.
    $('#confirmationModal').on('shown.bs.modal', function() {
        // Atualiza o conteúdo do modal com as informações do produto que será excluído.
        $('#confirmationModalBody').text('Tem certeza de que deseja excluir o item com ID ' +
            productIdToDelete + '?');
    });

    // Quando o botão "Excluir" do modal de confirmação é clicado, chama a função de exclusão.
    $('#confirmDelete').on('click', function() {
        console.log(productIdToDelete)
        var productId = productIdToDelete;
        deleteItem(productId);
        $('#confirmationModal').modal('hide');
    });


    function checkTableIsEmpty() {
        var tableBody = document.getElementById('produtoInfo');
        var emptyTableMessage = document.getElementById('tabelaVazia');
        
        if (tableBody.getElementsByTagName('tr').length === 0) {
            // A tabela está vazia, então mostra a mensagem de tabela vazia e oculta a tabela principal.
            emptyTableMessage.style.display = 'block';
            tableBody.style.display = 'none';
        } else {
           
        }
    }

    // Chame a função para verificar se a tabela está vazia ao carregar a página.
    document.addEventListener('DOMContentLoaded', checkTableIsEmpty);


    
