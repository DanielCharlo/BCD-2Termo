-- Criar banco de dados --
create database loja_informatica;

-- Ativar BD --
use loja_informatica;

create table produtos (
cod_produto int,
nome_produto varchar(100),
descricao_produto varchar(400),
preco_produto decimal,
imagem blob
);

create table estoque (
cod_estoque int,
nome_produto varchar(100),
quantidade int,
localidade varchar(100),
observacao varchar(250)
);

create table funcionarios (
cod_funcionario int,
nome_funcionario varchar(100),
data_nascimento datetime,
cpf varchar(14),
salario int
);

create table servicos (
cod_servico int,
tipo_servico varchar(150),
agendamento datetime,
valor_servico int,
observacao varchar(250)
);

create table clientes (
cod_cliente int,
nome_cliente varchar(100),
data_nascimento datetime,
cpf varchar(14),
endereco varchar(100)
);