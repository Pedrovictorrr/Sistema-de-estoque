// --------------------- criando categorias --------------////


document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to the submit button
    document.getElementById('submitButton').addEventListener('click', function(e) {
      e.preventDefault(); // Prevent default form submission
  
      var formData = getFormData();
  
      // Check if nomeCategoria is not empty
      if (formData.nomeCategoria.trim() === '') {
        alert('Campo "Nome da categoria" é obrigatório.');
        return;
      }
  
      // Get the selected checkbox values
      var selectedProducts = getSelectedCheckboxValues();
  
      // Prepare the data to be sent to the route
      var data = {
        nomeCategoria: formData.nomeCategoria,
        selectedProducts: selectedProducts,
        _token: document.getElementById("csrfToken").value,
      };
  
      // Show the confirmation modal before submitting the form
      var modal = document.getElementById('confirmationModal');
      modal.style.display = 'block';
  
      // Add event listeners to the modal buttons
      document.getElementById('confirmButton').addEventListener('click', function() {
        modal.style.display = 'none'; // Close the modal
  
        // Submit the form data using Fetch API
        fetch('/categorias/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(function(response) {
          if (response.ok) {
            console.log('Data sent successfully!');
            showSuccessMessage("Categoria criada com sucesso!"); // Show success message
            resetForm(); // Reset the form
          } else {
            console.error('Failed to send data.');
          }
        })
        .catch(function(error) {
          console.error('An error occurred:', error);
        });
      });
  
      document.getElementById('cancelButton').addEventListener('click', function() {
        modal.style.display = 'none'; // Close the modal
      });
    });
  
    // Function to show the success message card
   
  
    // Function to reset the form
    function resetForm() {
      document.getElementById('exampleFormControlInput1').value = ''; // Clear the input field
  
      // Uncheck all checkboxes
      var checkboxes = document.querySelectorAll('#NovaCategoria input[type="checkbox"]:checked');
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
      });
    }
  
    // Function to get the form data
    function getFormData() {
      var nomeCategoria = document.getElementById('exampleFormControlInput1').value;
      return { nomeCategoria: nomeCategoria };
    }
  
    // Function to get the list of selected products
    function getSelectedCheckboxValues() {
      var selectedCheckboxValues = [];
      var checkboxes = document.querySelectorAll('#NovaCategoria input[type="checkbox"]:checked');
      checkboxes.forEach(function(checkbox) {
        selectedCheckboxValues.push(checkbox.value);
      });
      return selectedCheckboxValues;
    }
  });

  function showSuccessMessage(message) {
    var mensagemExclusaoElement = $('#mensagemExclusao');
    mensagemExclusaoElement.text(message);
    mensagemExclusaoElement.show();
    setTimeout(function() {
        mensagemExclusaoElement.hide();
    }, 3000); // A mensagem será ocultada após 3 segundos (pode ajustar esse valor conforme necessário).
}


// ----------------------------- table de categorias existentes -------------------------- //


document.addEventListener("DOMContentLoaded", function () {
    // Selecione apenas os botões com a classe "open-modal"
    const editButtons = document.querySelectorAll(".open-modal");

    // Adicione um evento de clique a cada botão "Editar"
    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Obtenha as informações da categoria do atributo de dados
            const categoriaId = button.getAttribute("data-id");
            const categoriaNome = button.getAttribute("data-nome");


            // Preencha o modal com as informações da categoria
            document.getElementById("inputCategoriaId").value = categoriaId;
            document.getElementById("inputCategoriaIdPost").value = categoriaId;
            document.getElementById("inputCategoriaNome").value = categoriaNome;
         

            // Abra apenas o modal da categoria
            $("#categoriaModal").modal("show");
        });
    });

    // ... Resto do código
});

$(document).ready(function () {
    // Handle the click event of the "Editar" button
    $("#submitButtonEdit").click(function () {
        // Get the form data
        var formData = $("#editarCategoria").serializeArray();

        // Convert the form data to a JSON object
        var jsonData = {};
            $.each(formData, function (index, field) {
                if (field.name === 'idProduto') {
                    // If it's the "idProduto" field, check if it already exists in the jsonData
                    if (jsonData.hasOwnProperty(field.name)) {
                        // If it exists, convert the value to an array and push the new value
                        jsonData[field.name] = [].concat(jsonData[field.name], field.value);
                    } else {
                        // If it doesn't exist, simply set the value as an array with one element
                        jsonData[field.name] = [field.value];
                    }
                } else {
                    // For other fields, assign the value directly
                    jsonData[field.name] = field.value;
                }
            });
        jsonData = JSON.stringify(jsonData);
        // Make an AJAX POST request to your server endpoint
        $.ajax({
            type: "POST",
            url: "/categorias/edit", // Replace with your server endpoint URL
            data: {jsonData,
                _token: document.getElementById("csrfToken").value,},
            // Set the contentType to "application/x-www-form-urlencoded"
            contentType: "application/x-www-form-urlencoded",
            success: function (response) {
                showSuccessMessage("Categoria editada com sucesso!");
                $("#categoriaModal").modal("hide");
            },
            error: function (xhr, status, error) {
                // Handle errors, if any
                console.error("Error occurred:", error);
            }
        });
    });
});

// ----------------------- excluir item -------------------- // 

$(document).ready(function() {
    // Captura o evento de clique no botão "Excluir"
    $(".btn-excluir").on("click", function() {
        // Obtém o ID da categoria associada ao botão "Excluir"
        var categoriaId = $(this).data("id");

        // Define o modal de confirmação
        var modalConfirmacao = $("#confirmModal");

        // Mostra o modal de confirmação
        modalConfirmacao.modal("show");

        // Configura o evento de clique para o botão "Excluir" dentro do modal de confirmação
        $("#btnConfirmExcluir").on("click", function() {
            // Fecha o modal de confirmação
            modalConfirmacao.modal("hide");

            // Define a rota para onde a solicitação AJAX será enviada
            var rotaExclusao = "/categorias/delete"; // Substitua pelo URL correto da rota

            // Envia a solicitação AJAX com o ID da categoria
            $.ajax({
                url: rotaExclusao,
                type: "POST",
                data: {
                    id: categoriaId,
                    _token: document.getElementById("csrfToken").value,
                },
                success: function(response) {
                    // Aqui você pode lidar com a resposta da rota de exclusão, se necessário
                    showSuccessMessage("Categoria excluída com sucesso!");

                    // Remova a linha da tabela após a exclusão (opcional)
                    $(this).closest("tr").remove();
                },
                error: function(error) {
                    // Aqui você pode lidar com erros, se ocorrerem
                    showSuccessMessage("Erro ao excluir categoria:", error);
                }
            });
        });
    });
});