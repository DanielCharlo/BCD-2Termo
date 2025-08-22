create database SOLAR;

use SOLAR;

create table fornecedor (
id_fornecedor int primary key auto_increment not null,
nome_fornecedor varchar(100) not null,
CNPJ varchar(18) not null,
endereco varchar(100),
celular varchar(19),
estado varchar(2) default 'SP',
cidade varchar(30) default 'limeira'
);

create table produtos (
id_produtos int primary key	auto_increment not null,
nome_produtos varchar(100) not null,
valor_produto decimal (5,2) not null,
qtde_produto int not null,
descricao_produto varchar(200)
);

create table venda (
id_venda int primary key auto_increment not null,
id_produto int not null,
id_fornecedor int not null,
foreign key (id_produto) references produtos (id_produtos),
foreign key (id_fornecedor) references fornecedor (id_fornecedor)
);

create table if not exists clientes (
id_cliente int primary key auto_increment not null,
nome_cliente varchar(100), 
CPF varchar(14) not null,
endereco varchar(100),
celular varchar(19)
);

create table funcionario (
id_funcionario int primary key auto_increment not null,
nome_funcionario varchar(100) not null,
idade_funcionario int not null,
CPF varchar(14),
cargo varchar(100),
salario decimal (5,2),
data_nascimento datetime not null,
data_admissao datetime not null,
data_recisao datetime not null,
endereco_funcionario varchar(100) not null,
id_departamento int not null,
foreign key (id_departamento) references departamento (id_departamento)
);

create table departamento (
id_departamento int primary key auto_increment not null,
nome_departamento varchar(100),
funcao_departamento varchar(100)
);

SELECT * FROM funcionario;

-- alterações em tabelas
alter table funcionario
add sexo char(1);

alter table funcionario
drop column sexo;

alter table funcionario
rename to empregado;

alter table empregado
change CPF CIC VARCHAR(18);

alter table empregado
modify column nome_funcionario varchar(200);

alter table fornecedor
modify column estado char(2) default 'MG';

alter table empregado modify CPF int not null;
alter table empregado drop primary key;

alter table empregado
add primary key (id_funcionario,CPF);


