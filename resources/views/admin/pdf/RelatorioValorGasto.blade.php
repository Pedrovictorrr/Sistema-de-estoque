<!DOCTYPE html>
<html>
<head>
    <title>Relatório dos últimos 10 dias</title>
    <style>
          table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
   <center> <h1>Relatório dos últimos 10 dias</h1></center>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($valorTotalPorDia as $data => $valorTotal)
                <tr>
                    <td>{{ $data }}</td>
                    <td>R$ {{ number_format($valorTotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>