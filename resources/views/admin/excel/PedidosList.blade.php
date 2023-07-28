<table>
    <thead>
    <tr>
        <th >#</th>
        <th >Remetente</th>
        <th >Destinatario</th>
        <th >Qtd. itens</th>
        <th >Valor Total</th>
        <th >Data de criação</th>
        <th >Documento</th>
    </tr>

    </thead>
    <tbody>
    @foreach($pedidos as $pedido)
       
            <tr >
                <th >{{ $pedido->id }}</th>
                <td>{{ $pedido->user->name }}</td>
                <td>{{ $pedido->destinatario->name }}</td>
                <td>{{ $pedido->Qtd_itens }}</td>
                <td>{{ number_format( $pedido->Valor_total, 2, ',', '.') }}</td>
                <td>{{ $pedido->created_at }}</td>
            </tr>
       
    @endforeach
    </tbody>
</table>