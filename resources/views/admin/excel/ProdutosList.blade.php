<table>
    <thead>
    <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Valor total em estoque</th>
        <th>Quantidade de produtos</th>
        <th>Validade</th>
        <th>Data de atualização</th>
        <th>Data de criação</th>
    </tr>
    </thead>
    <tbody>
    @foreach($produtos as $produto)
        <tr>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->categoria->NomeCategoria }}</td>
            <td>{{ $produto->descricao }}</td>
            <td>{{ $produto->preco }}</td>
            <td>{{ number_format($produto->Qtd_Produtos * $produto->preco, 2, ',', '.') }}</td>
            <td>{{ $produto->Qtd_Produtos }}</td>
            <td>{{ $produto->data_vencimento }}</td>
            <td>{{ $produto->updated_at }}</td>
            <td>{{ $produto->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>