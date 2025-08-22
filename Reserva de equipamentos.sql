create database RESERVA_EQUIPAMENTOS;

use RESERVA_EQUIPAMENTOS;

create table Equipamentos (
id_equipamento int primary key auto_increment not null,
Nome_Equipamento varchar(100) not null,
Descricao varchar(200),
Statuss varchar(100) default 'disponivel'
);

create table usuario (
id_usuario int primary key auto_increment not null,
Nome_Usuario varchar(100) not null,
CPF varchar(14) not null,
Celular varchar(19),
Endereco varchar(100) not null
);

create table funcionario (
id_funcionario int primary key auto_increment not null,
nome_funcionario varchar(100) not null,
telefone varchar(19) not null,
cargo varchar(100) not null,
salario decimal(5,2) not null
);