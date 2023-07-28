<!-- admin/pdf/RelatorioValorGasto.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Produtos em Estoque</title>
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
    <center><h1>Relatório de Produtos em Estoque</h1></center>

    <table>
        <thead>
            <tr>
                <th >Cod.</th>
                <th >Nome</th>
                <th >Categoria</th>
                <th >Quantidade</th>
                <th >Valor por unidade</th>
                <th >Valor em estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
            <tr>
                <th >{{ $produto->id }}</th>
                <td >{{ $produto->nome }}</td>
                <td >{{ $produto->categoria->NomeCategoria }}</td>
                <td>{{ $produto->Qtd_Produtos }}</td>
                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td>R$
                    {{ number_format($produto->Qtd_Produtos * $produto->preco, 2, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>