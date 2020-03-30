# Relatório de Vendas

> Relatório de vendas feito em PHP utilizando o framework Lumen.

![](https://i.ibb.co/CvJbGc3/dashboard.png)

## Visão Geral
O usuário fará a autenticação com login e senha, e em caso de sucesso, o retorno será um token emitido pelo `JWT`. Caso o usuário não possua uma conta, basta clicar no botão de registro dentro do formulário de autenticação.

Dentro do painel, há 2 páginas: 
 - **Dashboard:** Um card resumindo as vendas na semana e um relatório com as últimas vendas;
 - **Vendas:** Relatório com todas as vendas.


## Fluxo de uso
Após a autenticação, o cliente terá a permissão de criar uma venda, com sua descrição (o que vendeu), fonte (onde vendeu), data e valor, também poderá editar, remover e exportar o relatório para uma planilha.


## API
Todas as requisições chamam pela API estruturada no diretório `./api`, para sua utilização, basta cloná-lo e instalar as dependências com o `composer`.


## Meta
Victor Hugo – vhuugoc@gmail.com

[https://github.com/vhugoc/crude-vendas](https://github.com/vhugoc/crude-vendas)

