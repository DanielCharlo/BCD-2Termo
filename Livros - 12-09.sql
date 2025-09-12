-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.

CREATE TABLE Editoras (
  Codigo_Editora int auto_increment not null PRIMARY KEY,
  CNPJ varchar(18),
  Nome_Editora varchar(100),
  Endereco varchar(200),
  Contato varchar(50),
  Telefone varchar(20),
  Cidade varchar(50)
);

CREATE TABLE Autores (
  Codigo_Autor int auto_increment not null PRIMARY KEY,
  Nome varchar(100),
  Nacionalidade varchar(30),
  DataNascimento date
);

CREATE TABLE Livros (
  Codigo_Livro int auto_increment not null PRIMARY KEY,
  Autor varchar(100),
  Editora varchar(100),
  Genero varchar(100),
  Preco decimal(10,2),
  Titulo varchar(100),
  Quantidade int
);

CREATE TABLE Clientes (
  Codigo_Cliente int auto_increment not null PRIMARY KEY,
  CPF varchar(14),
  Telefone varchar(20),
  Cdatanascimento date,
  Nome_Cliente varchar(100),
  Email varchar(300)
);

CREATE TABLE Vendas (
  Codigo_Venda int auto_increment not null PRIMARY KEY,
  DataVenda datetime,
  Nome_Cliente varchar(100),
  Titulo varchar(100),
  Quantidade int,
  ValorTotal decimal(10,2),
  Codigo_Cliente int,
  FOREIGN KEY (Codigo_Cliente) REFERENCES Clientes(Codigo_Cliente)
);

CREATE TABLE Escrito (
  Codigo_Autor int not null,
  Codigo_Livro int not null,
  PRIMARY KEY (Codigo_Autor, Codigo_Livro),
  FOREIGN KEY (Codigo_Autor) REFERENCES Autores(Codigo_Autor),
  FOREIGN KEY (Codigo_Livro) REFERENCES Livros(Codigo_Livro)
);

CREATE TABLE Vende (
  Codigo_Cliente int not null,
  Codigo_Venda int not null,
  PRIMARY KEY (Codigo_Cliente, Codigo_Venda),
  FOREIGN KEY (Codigo_Cliente) REFERENCES Clientes(Codigo_Cliente),
  FOREIGN KEY (Codigo_Venda) REFERENCES Vendas(Codigo_Venda)
);

CREATE TABLE Publica (
  Codigo_Livro int not null,
  Codigo_Editora int not null,
  PRIMARY KEY (Codigo_Livro, Codigo_Editora),
  FOREIGN KEY (Codigo_Livro) REFERENCES Livros(Codigo_Livro),
  FOREIGN KEY (Codigo_Editora) REFERENCES Editoras(Codigo_Editora)
);
