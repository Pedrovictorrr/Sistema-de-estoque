<!DOCTYPE html>
<html>
<head>
    <title>Documento para Liberação de Itens do Estoque</title>
</head>
<body>
    <h2>Nome da Sua Empresa</h2>

    <p>Para: Equipe de Gestão de Estoque / Funcionários do Depósito</p>

    <p>Assunto: Liberação de Itens do Estoque</p>


    <p>Estamos escrevendo este documento para autorizar oficialmente a liberação de itens específicos do nosso estoque.</p>

    <p>Detalhes da Liberação do Estoque:</p>

    <p>Data da Liberação: {{ $pedido->created_at }}</p>

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
                            <th scope="row">{{$item->produto->id}}</th>
                            <td>{{$item->produto->nome}}</td>
                            <td>{{$item->Qtd_produtos}}</td>
                            <td>R${{($item->produto->preco) }}</td>
                            <td>R${{ (float) ($item->produto->preco * $item->Qtd_produtos) }}.00</td>
                        </tr>
                    @endforeach
        </tbody>
    </table>

    <p>Por favor, garantam que os itens listados acima sejam liberados do nosso estoque e devidamente documentados para fins de rastreamento.</p>

    <p>Ao assinar abaixo, você confirma que revisou cuidadosamente as informações neste documento, entende a finalidade da liberação de estoque e reconhece sua responsabilidade em realizar o processo de liberação de acordo com as diretrizes e protocolos da empresa.</p>

    <p>Assinatura: ____________________________</p>


    <p>Data: ____________________________</p>
 

    <p>Se tiverem alguma dúvida ou necessitarem de esclarecimentos adicionais, por favor, sintam-se à vontade para entrar em contato com [Seu Nome ou Pessoa de Contato Designada] através do telefone [Seu Número de Contato] ou do e-mail [Seu Endereço de E-mail].</p>

    <p>Agradecemos a colaboração de todos neste assunto.</p>

</body>
</html>
