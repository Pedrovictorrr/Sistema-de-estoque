@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div>
        <h1 class="text-center">Fazer Pedido</h1>
    </div>


@stop

@section('content')
    <div class="container-xxl d-flex justify-content-center">
        <div class="col-md-12 p-5 border bg-white rounded shadow">
            <div class="input-group col-md-6 p-3">
                <input type="hidden" id="csrfToken" name="_token" value="{{ csrf_token() }}">
                <select class="custom-select col-md-10" id="inputGroupSelect04" aria-label="Example select with button addon"
                    onchange="updateMaxValue()">
                    <option>Selecione um produto</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
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


            <div class="p-3">
                <table id="produtoTable" class="table table-bordered">
                    <thead>
                        <tr> 
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
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <div class="p-1">
                    <button class="btn-primary btn">
                        Enviar pedido
                    </button>
                </div>
                <div class="p-1">
                    <button class="btn-secondary btn">
                        Limpar
                    </button>
                </div>
                <div class="p-1">
                    <button class="btn-danger btn">
                        Cancelar
                    </button>
                </div>

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
                success: function(response) {
                    console.log(response);

                    // Add the selected product data to the table
                    var tableBody = $("#produtoTable tbody");
                    var newRow = "<tr>" +
                        
                        "<td>" + response.id + "</td>" +
                        "<td>" + "<img height='50px' height='50px' src='" + response.foto + "' alt='Product Photo'>" + "</td>" +
                        "<td>" + response.produto + "</td>" +
                        "<td>" + response.categoria + "</td>" +
                        "<td>" + quantidade + "</td>" +
                        "<td>R$" + response.valor + "/ por unidade</td>" +
                        "<td>" +
                        "<button type='button' class='btn btn-sm btn-danger' onclick='excluirProduto(this)'>Excluir</button>" +
                        "<button type='button' class='btn btn-sm btn-primary' onclick='editarProduto(this)'>Editar</button>" +
                        "</td>" +
                        "</tr>";
                    tableBody.append(newRow);

                    // Clear the selected product and quantity
                    $("#inputGroupSelect04").val("");
                    $("#quantidadeSelect").empty().append(new Option("Quantidade máxima", ""));
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }
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
                success: function(response) {
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
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }

        function excluirProduto(button) {
            // Remove the selected product row from the table
            $(button).closest("tr").remove();
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
    </script>
@stop
