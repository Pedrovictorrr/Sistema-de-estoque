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