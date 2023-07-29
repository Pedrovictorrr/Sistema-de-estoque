# W2O

Diagrama:

Relação das tabelas no banco de dados:

Tabela "produtos":

- A tabela "produtos" possui um campo "id_categoria" que é uma chave estrangeira (FK) relacionada à tabela "categorias".
- Um produto está associado a apenas uma categoria.
- Uma categoria pode ter vários produtos.


Tabela "itensPedidos":

- A tabela "itenspedidos" possui um campo "id_produto" que é uma chave estrangeira (FK) relacionada à tabela "produtos".
- Um item de pedido está associado a apenas um produto.
- Um produto pode estar presente em vários itens de pedidos.
- A tabela "itensPedidos" possui um campo "id_pedido" que é uma chave estrangeira (FK) relacionada à tabela "pedidos".
- Um item de pedido está associado a apenas um pedido.
- Um pedido pode ter vários itens de pedidos.

Tabela "pedidos":

- A tabela "pedidos" possui dois campos relacionados a um usuário: "destinatario" e "user_id", ambos são chaves estrangeiras (FKs) relacionadas à tabela "users".
- Um pedido está associado a apenas um usuário (como destinatário).
- Um pedido está associado a apenas um usuário (como remetente 'user_id').
- Um usuário pode ter vários pedidos.

Resumindo:

A tabela "produtos" se relaciona com a tabela "categorias".
A tabela "itenspedidos" se relaciona com a tabela "produtos".
A tabela "itensPedidos" (supondo que seja uma tabela de pedidos) se relaciona com a tabela "pedidos".
A tabela "pedidos" se relaciona com a tabela "users" para indicar o destinatário e o usuário associado ao pedido.

![image](https://github.com/Pedrovictorrr/W2O/assets/82172897/1d613b15-f13e-465d-b1a3-8b418571b154)

