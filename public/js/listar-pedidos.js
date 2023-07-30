$(document).ready(function() {
    // Function to filter the rows based on the search query
    function filterTableRows() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("produtoInfo");
        tr = table.getElementsByClassName("product-row");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            var foundMatch = false;
            for (var j = 0; j <
                3; j++) { // Change this to 3 to search the first three columns (index 0, 1, and 2)
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    foundMatch = true;
                    break;
                }
            }
            tr[i].style.display = foundMatch ? "" : "none";
        }
    }

    // Add an event listener to the search input field
    $("#searchInput").on("input", function() {
        filterTableRows();
    });
});

$(document).ready(function() {
    // Function to filter the rows based on the search query
    function filterTableRows() {
        // ... Your existing filterTableRows function code ...
    }

    // Add an event listener to the search input field
    $("#searchInput").on("input", function() {
        filterTableRows();
    });

    // Event listener for the "Ver" button click
    $(".ver-button").on("click", function() {
        var $row = $(this).closest("tr"); // Get the closest row to the clicked button
        var orderId = $row.find("strong").text();
        var userName = $row.find("td:eq(1)").text();
        var destinatarioName = $row.find("td:eq(2)").text();
        var qtd = $row.find("td:eq(3)").text();
        var valorTotal = $row.find("td:eq(4)").text();
        var dataCriacao = $row.find("td:eq(5)").text();

        // Populate the modal fields with the extracted information
        $("#modalOrderId").text(orderId);
        $("#modalId").text(orderId);
        $("#modalUserName").text(userName);
        $("#modalDestinatarioName").text(destinatarioName);
        $("#modalQTD").text(qtd);
        $("#modalValorTotal").text(valorTotal);
        $("#modaldataCriacao").text(dataCriacao);
    });
});