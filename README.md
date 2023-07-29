# W2O

<p>Realizei a implementação do Projeto de Controle de Estoque e Gerenciamento de Categorias com sucesso. Fui responsável por desenvolver uma solução eficiente que possibilita o registro e rastreamento das movimentações de entrada e saída de produtos, além de organizar os itens em categorias para simplificar a gestão.</p>
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

<strong>Gerar a chave de criptografia:<br></strong>
O Laravel exige uma chave de criptografia para proteger dados sensíveis. Execute o seguinte comando para gerar uma nova chave no arquivo .env:

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
obs.:Ele vai perguntar se quer criar um novo banco, você digita 'yes'.
<br><br>

<strong>Vamos alimentar esse banco de dados com alguns itens aleatorios e adicionar os usuarios com seeders:</strong>

```bash
php artisan db:seed
```

<strong>Agora é só rodar o servidor:</strong>

```bash
php artisan serve
```

<strong>Url de desenvolvimento:</strong>

```bash
http://127.0.0.1:8000/
```

## Telas do sistema:
| Login |  Home | Fazer pedido |
| -------- | -------- | -------- |
| ![Imagem 1](https://github.com/Pedrovictorrr/W2O/assets/82172897/6f2abff2-8888-4c76-b245-8fc4af7402ed) | ![Imagem 2](https://github.com/Pedrovictorrr/W2O/assets/82172897/b51a44a6-5d81-48a6-9b88-785cb5a7380f) | ![Imagem 3](https://github.com/Pedrovictorrr/W2O/assets/82172897/766b274b-249f-426a-8ac4-c2e117b417de) |
| Inserir produtos | Listar Produtos | Listar Pedidos |
| ![Imagem 4](https://github.com/Pedrovictorrr/W2O/assets/82172897/5b858ef3-5ab9-4c6b-bf1d-77ecddc9fc3f) | ![Imagem 5](https://github.com/Pedrovictorrr/W2O/assets/82172897/776f9a70-648d-42fb-9c60-ef42f2038068) | ![Imagem 6](https://github.com/Pedrovictorrr/W2O/assets/82172897/522dcc20-d289-4ee7-8a82-dfa7626049cd) |
| Relatórios |  |  |
| ![Imagem 7](https://github.com/Pedrovictorrr/W2O/assets/82172897/3aa07509-5ba1-4b74-a69b-4d674d31b77d) |  |  |
|  |  |  |







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




