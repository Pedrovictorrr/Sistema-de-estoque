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
                <td>{{ $valorTotal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>