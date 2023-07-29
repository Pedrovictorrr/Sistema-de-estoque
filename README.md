# W2O
## Como começar:

<strong>Passo a passo:<br></strong>

<strong>Clonar o repositorio do projeto para sua maquina:</strong>
```bash
git clone https://github.com/Pedrovictorrr/W2O.git
```
<strong>Instalar dependencias composer:</strong>
```bash
composer install
```

<strong>Fazer copia do arquivo .env:</strong>

```bash
cp .env.example .env
```

<strong>Gerar a chave de criptografia:<br>
O Laravel exige uma chave de criptografia para proteger dados sensíveis. Execute o seguinte comando para gerar uma nova chave no arquivo .env:</strong>

```bash
php artisan key:generate
```

<strong>Alterar campos de do banco de dados para algum banco de dados mysql fica da sua escolha o nome aqui esta um exemplo (local):</strong>

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=W20-Teste
DB_USERNAME=root
DB_PASSWORD=[SUA_SENHA_DO_BANCO_DE_DADOS]
```

<strong>Depois do banco de dados configurado, vamos rodar a migrate:</strong>

```bash
php artisan migrate
```
<br>
<strong>obs.:Ele vai perguntar se quer criar um novo banco, você digita 'yes'.</strong>

Vamos alimentar esse banco de dados com alguns itens aleatorios e adicionar os usuarios com seeders:

```bash
php artisan db:seed
```

## Modelagem de dados (Diagrama):

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
- Um pedido está associado a apenas um usuário (como remetente, 'user_id').
- Um usuário pode ter vários pedidos.

Resumindo:

A tabela "produtos" se relaciona com a tabela "categorias".
A tabela "itenspedidos" se relaciona com a tabela "produtos".
A tabela "itensPedidos" (supondo que seja uma tabela de pedidos) se relaciona com a tabela "pedidos".
A tabela "pedidos" se relaciona com a tabela "users" para indicar o destinatário e o usuário associado ao pedido.

![image](https://github.com/Pedrovictorrr/W2O/assets/82172897/1d613b15-f13e-465d-b1a3-8b418571b154)

