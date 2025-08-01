

create table clientes (
id_cliente int primary key,
nome_cliente char(30),
email_cliente char (50),
senha_cliente char(90),
endereço_cliente char(90)
);

create table funcionarios (
id_funcionarios int primary key,
nome_funcionario char(30),
cargo_funcionario char(30),
salario_funcionario char (20)
);

create table pizzas (
id_pizza int primary key,
sabor_pizza char(40),
ingredientes_pizza char(90),
preco_pizza char(60)
);