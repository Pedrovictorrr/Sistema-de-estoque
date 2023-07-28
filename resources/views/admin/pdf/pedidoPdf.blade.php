<!DOCTYPE html>
<html>

<head>
    <title>Documento para Liberação de Itens do Estoque</title>
</head>

<body>
    <h2>W2O Softwares e Aplicativos </h2>

    <p><strong>Para:</strong> Equipe de Gestão de Estoque / Funcionários do Depósito</p>

    <p><strong>Assunto:</strong> Liberação de Itens do Estoque</p>

    <p><strong>Mensagem:</strong>Estamos escrevendo este documento para autorizar oficialmente a liberação de itens
        específicos do nosso estoque.</p>

    <p><strong>Detalhes da Liberação do Estoque:</strong></p>

    <p><strong>Data da Liberação: </strong>{{ $pedido->created_at }}</p>

    <p><strong>Remetente:</strong> {{ $pedido->user->name }}</p>
    <p><strong>Email do Remetente: </strong>{{ $pedido->user->email }}</p>

    <p><strong>Destinatário:</strong> {{ $pedido->destinatario->name }}</p>
    <p><strong>Email do Destinatário:</strong> {{ $pedido->destinatario->email }}</p>


    <p>Por favor, garantam que os itens listados acima sejam liberados do nosso estoque e devidamente documentados para
        fins de rastreamento.</p>

    <p>Ao assinar abaixo, você confirma que revisou cuidadosamente as informações neste documento, entende a finalidade
        da liberação de estoque e reconhece sua responsabilidade em realizar o processo de liberação de acordo com as
        diretrizes e protocolos da empresa.</p>

    <p>Assinatura do Remetente: ____________________________</p>
    <p>Data: ____________________________</p>

    <p>Assinatura do Destinatário: ____________________________</p>
    <p>Data: ____________________________</p>


    <p>Se tiverem alguma dúvida ou necessitarem de esclarecimentos adicionais, por favor, sintam-se à vontade para
        entrar em contato com o coordenador do setor através do e-mail {{ $pedido->user->email }}.</p>

    <p>Agradecemos a colaboração de todos neste assunto.</p>
    
    <p>Lista de Itens:</p>
    <table border="1">
        <thead>
            <tr>
                <th>Código do Item</th>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Valor por Unidade</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itens as $item)
                <tr>
                    <th scope="row">{{ $item->produto->id }}</th>
                    <td>{{ $item->produto->nome }}</td>
                    <td>{{ $item->Qtd_produtos }}</td>
                    <td>R${{ number_format($item->produto->preco, 2) }}</td>
                    <td>R${{ number_format($item->produto->preco * $item->Qtd_produtos, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
