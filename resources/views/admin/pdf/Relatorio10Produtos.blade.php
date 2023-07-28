<!DOCTYPE html>
<html>
<head>
    <title>Relatório dos 10 Produtos Mais Frequentes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Relatório dos 10 Produtos Mais Frequentes</h2></center>

    <table>
        <thead>
            <tr>
                <th>Código do Produto</th>
                <th>Nome do Produto</th>
                <th>Total de Aparições</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itensMaisFrequentes as $item)
                <tr>
                    <td>{{ $item['id_produto'] }}</td>
                    <td>{{ $item['nome_produto'] }}</td>
                    <td>{{ $item['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
