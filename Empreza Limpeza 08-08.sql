create database empresa_limpeza;

use empresa_limpeza;

create table Produtos (
	cod_produtos int,
    Descricao_Produto varchar(100),
    Marca_Produto varchar(100),
    Nome_Produto varchar(100),
    Preco_Produto decimal
);

create table Funcionarios (
    Cod_Funcionarios int,
    Nome_Funcionario varchar(100),
    Cargo_Funcionario varchar(100),
    Salario_Funcionario decimal,
    Setor_Funcionario varchar(100)
);

create table Vendas (
    Cod_Vendas int,
    Cod_Produtos int,
    preco_venda decimal,
    formapag_venda varchar(100),
    data_venda datetime,
    quantidade_venda int
);

create table Manutencao (
    Cod_Manutencao int,
    Tecnico_Manutencao varchar(100),
    Valor_Manutencao decimal,
    Cliente_Manutencao varchar(100),
    agendamento_manutencao datetime,
    servico_manutencao varchar(255)
);

create table Processos (
    Cod_Processos int,
    Data_inicio datetime,
    Data_fim datetime,
    Produto varchar(100),
    Quantidade int
);
