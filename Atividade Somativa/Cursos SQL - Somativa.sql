CREATE DATABASE IF NOT EXISTS COTIL;
USE COTIL;

-- Criação das Tabelas
CREATE TABLE Cursos (
    idCursos int NOT NULL PRIMARY KEY,
    Titulo varchar(150),
    Carga_horaria int,
    Descricao varchar(200),
    Status varchar(20)
);

CREATE TABLE Alunos (
    idAlunos int NOT NULL PRIMARY KEY,
    Nome varchar(150),
    Email varchar(200) NOT NULL,
    Data_nascimento date
);

CREATE TABLE Inscricoes (
    idInscricoes int NOT NULL PRIMARY KEY,
    idAlunos int NOT NULL,
    idCursos int NOT NULL,
    Data_inscricao date,
    FOREIGN KEY(idAlunos) REFERENCES Alunos(idAlunos),
    FOREIGN KEY(idCursos) REFERENCES Cursos(idCursos)
);

CREATE TABLE Avaliacoes (
    idAvaliacoes int NOT NULL PRIMARY KEY,
    idInscricoes int NOT NULL,
    Nota decimal(4,1),
    Comentario varchar(100),
    FOREIGN KEY(idInscricoes) REFERENCES Inscricoes(idInscricoes)
);

-- Inserindo dados
INSERT INTO Alunos (idAlunos, Nome, Email) VALUES
(1, 'Maria Joaquina', 'maria.joaquina@email.com'),
(2, 'João Gomes', 'joao.gomes@email.com'),
(3, 'Cirilo', 'Cirilo.chave@email.com'),
(4, 'Jailson Mendes', 'Jailson.mendes@email.com'),
(5, 'Neymar Junior', 'neymar.junior@email.com');

INSERT INTO Cursos (idCursos, Titulo, Carga_horaria, Descricao, Status) VALUES
(1, 'Informática Básica', 40, 'Uso do computador, pastas e arquivos', 'ativo'),
(2, 'Excel para Iniciantes', 30, 'Planilhas simples e fórmulas básicas', 'ativo'),
(3, 'Word e Digitação', 25, 'Ferramentas do Word e prática de texto', 'ativo'),
(4, 'Internet e E-mail', 20, 'Navegação segura e uso do e-mail', 'ativo'),
(5, 'Photoshop Básico', 35, 'Introdução à edição de imagens', 'inativo');

INSERT INTO Inscricoes (idInscricoes, idAlunos, idCursos, Data_inscricao) VALUES
(1, 1, 1, '2025-09-11'),
(2, 2, 2, '2025-09-22'),
(3, 3, 3, '2025-10-03'),
(4, 4, 4, '2025-08-31'),
(5, 5, 1, '2025-09-07');

INSERT INTO Avaliacoes (idAvaliacoes, idInscricoes, Nota, Comentario) VALUES
(1, 1, 8.5, 'Bom desempenho, mas pode melhorar.'),
(2, 2, 9.0, 'Ótima participação nas aulas.'),
(3, 5, 7.0, 'Teve dificuldades em alguns pontos.');

-- Alterando dados
UPDATE Alunos
SET Email = 'Cirilo.chavoso@gmail.com'
WHERE idAlunos = 3;

UPDATE Cursos
SET Carga_horaria = 100
WHERE idCursos = 4;

UPDATE Alunos
SET Nome = 'Cirilo Chavoso'
WHERE idAlunos = 3;

UPDATE Cursos
SET Status = 'inativo'
WHERE idCursos = 2;

UPDATE Avaliacoes
SET Nota = 7.5
WHERE idAvaliacoes = 3;

-- Deletando
DELETE FROM Avaliacoes WHERE idAvaliacoes = 2;

DELETE FROM Inscricoes WHERE idInscricoes = 2;

DELETE FROM Alunos WHERE idAlunos = 2;

DELETE FROM Cursos WHERE idCursos = 5;

-- Consultando
SELECT * FROM Alunos;

SELECT Nome, Email FROM Alunos;

SELECT * FROM Cursos WHERE Carga_horaria > 30;

SELECT * FROM Cursos WHERE Status = 'inativo';

SELECT * FROM Alunos WHERE Data_nascimento > '1995-12-31';

SELECT * FROM Avaliacoes WHERE Nota > 9;

SELECT COUNT(*) AS Total_Cursos FROM Cursos;

SELECT * FROM Cursos ORDER BY Carga_horaria DESC LIMIT 3;
