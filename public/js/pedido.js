var produtosArray = []

function adicionarProduto() {
    var selectedProductId = $("#inputGroupSelect04").val();
    var quantidade = $("#quantidadeSelect").val();
    var csrfToken = $("#csrfToken").val();


    if (selectedProductId && quantidade > 0) {
        // Check if the product is already in the table
        if (produtoJaNaTabela(selectedProductId)) {
            alert("Este produto já foi adicionado à tabela.");
            return; // Exit the function to prevent adding the same product again
        }

        // Make an AJAX request to the server
        $.ajax({
            url: "/adicionarProdutoCarrinho", // Replace this with the URL to your server-side route that handles the request
            method: "POST",
            data: {
                _token: csrfToken,
                productId: selectedProductId,
            },
            dataType: "json",
            success: function (response) {
                if (response.foto == null) {
                    response.foto = '/storage/imagens/product_example.png';
                }

                var Destinatario = $("#Destinatario").val();
              
                console.log(Destinatario)
       
                var produto = {
                    id: response.id,
                    Destinatario: Destinatario,
                    foto: response.foto,
                    produto: response.produto,
                    categoria: response.categoria,
                    quantidade: quantidade,
                    valor: response.valor,
                };

                // Add the product object to the array
                produtosArray.push(produto)

                atualizarInputHidden();
                // Add the selected product data to the table
                var tableBody = $("#produtoTable tbody");
                var newRow = "<tr class='text-center'>" +

                    "<td>" + response.id + "</td>" +
                    "<td>" + "<img height='50px' height='50px' src='" + response.foto +
                    "' alt='Product Photo'>" + "</td>" +
                    "<td>" + response.produto + "</td>" +
                    "<td>" + response.categoria + "</td>" +
                    "<td>" + quantidade + "</td>" +
                    "<td>R$" + response.valor + "/ por unidade</td>" +
                    "<td>" +
                    "<button type='button' class='btn btn-danger' onclick='excluirProduto(this)'>Remover</button>" +
                    "</td>" +
                    "</tr>";
                tableBody.append(newRow);

                // Clear the selected product and quantity
                $("#inputGroupSelect04").val("");
                $("#quantidadeSelect").empty().append(new Option("Quantidade máxima", ""));
            },
            error: function (error) {

            }
        });
    }
}

function atualizarInputHidden() {
    // Clear the previous inputs
    $("#produtosArrayInput").empty();

    // Create inputs hidden with the values of the array
    produtosArray.forEach(function (produto, index) {
        var input = "<input type='hidden' name='produtosArray[" + index + "]' value='" + JSON.stringify(
            produto) + "'>";
        $("#produtosArrayInput").append(input);
    });
}


function produtoJaNaTabela(productId) {
    // Check if the selected product ID is already in the table
    var table = $("#produtoTable");
    var existingProductIds = table.find("td:first-child").map(function () {
        return $(this).text();
    }).get();
    return existingProductIds.includes(productId);
}

function updateMaxValue() {
    var selectedProductId = $("#inputGroupSelect04").val();
    var csrfToken
    csrfToken = document.getElementById("csrfToken").value;
    console.log(csrfToken)

    // Make an AJAX request to the server
    $.ajax({
        url: "/getMaxValue", // Replace this with the URL to your server-side route that handles the request
        method: "POST",
        data: {
            _token: csrfToken,
            productId: selectedProductId

        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            $("#quantidadeInput").attr("max", response.maxValue);
            var newPlaceholder = "Quantidade máxima: " + response.maxValue;
            $("#quantidadeInput").attr("placeholder", newPlaceholder);

            var quantidadeSelect = $("#quantidadeSelect");
            quantidadeSelect.empty(); // Clear existing options

            if (response.maxValue > 0) {
                for (var i = 1; i <= response.maxValue; i++) {
                    quantidadeSelect.append(new Option(i, i));
                }
            } else {
                quantidadeSelect.append(new Option("Sem estoque", ""));
            }

        },
        error: function (error) {
            console.error("Error:", error);
        }
    });
}

function excluirProduto(button) {
    console.log(button)
    var index = $(button).closest("tr").index();
    removerProdutoDoArray(index);
    $(button).closest("tr").remove();

}

function removerProdutoDoArray(index) {
    if (index > -1 && index < produtosArray.length) {
        produtosArray.splice(index, 1);
        console.log(produtosArray)
    }
}


function editarProduto(button) {
    // Get the row containing the selected product
    var row = $(button).closest("tr");

    // Get the product and quantity data from the row
    var produto = row.find("td:eq(0)").text().trim();
    var quantidade = parseInt(row.find("td:eq(1)").text().trim());

    // Update the dropdown and input fields with the selected values
    $("#inputGroupSelect04").val(produto);
    $("#quantidadeSelect").val(quantidade);

    // Remove the row from the table
    row.remove();
}

function populateModal() {
    var produtoInfoDiv = document.getElementById('produtoInfo');
    produtoInfoDiv.innerHTML = ''; // Clear the previous content

    // Loop through the array and create a list of items
    var Destinatario = $("#Destinatario").text();
              
    console.log(Destinatario)
    produtosArray.forEach(function (response) {
        console.log(response)
        var tableBody = $("#produtoInfo");
        var newRow = "<tr>" +

            "<td>" + response.id + "</td>" +
            "<td>" + "<img height='50px' height='50px' src='" + response.foto +
            "' alt='Product Photo'>" + "</td>" +
            "<td>" + response.produto + "</td>" +
            "<td>" + response.categoria + "</td>" +
            "<td>" + response.quantidade + "</td>" +
            "<td>R$" + response.valor + "/ por unidade</td>" +
            "<td>" + Destinatario + "</td>" +
            "</tr>";
        tableBody.append(newRow);
    });


    // Append the list to the modal body
}

const modal = document.getElementById("myModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeBtn = document.getElementsByClassName("close")[0];

// Função para abrir o modal
function openModal() {
    modal.style.display = "block";
    populateModal()
}

// Função para fechar o modal
function closeModal() {
    modal.style.display = "none";
}

// Event listeners
openModalBtn.addEventListener("click", openModal);
closeBtn.addEventListener("click", closeModal);

// Fecha o modal quando o usuário clica fora da janela modal
window.addEventListener("click", function (event) {
    if (event.target === modal) {
        closeModal();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Seleciona o botão "Enviar pedido"
    const enviarPedidoBtn = document.getElementById("openModalBtn");

    // Seleciona a tabela onde os itens estão sendo listados
    const produtoTable = document.getElementById("produtoTable");

    // Função para verificar a quantidade de itens na lista e habilitar/desabilitar o botão
    function verificarQuantidadeItens() {
        // Conta o número de linhas na tabela, excluindo a última linha do rodapé
        const numItens = produtoTable.getElementsByTagName("tr").length - 1;

        // Habilita ou desabilita o botão com base no número de itens
        if (numItens > 1) {
            enviarPedidoBtn.disabled = false;
        } else {
            enviarPedidoBtn.disabled = true;
        }
    }

    // Chama a função para verificar a quantidade de itens ao carregar a página
    verificarQuantidadeItens();

    // Adiciona um event listener para verificar a quantidade de itens sempre que ocorrerem mudanças na lista
    produtoTable.addEventListener("DOMSubtreeModified", verificarQuantidadeItens);
});