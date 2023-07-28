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
