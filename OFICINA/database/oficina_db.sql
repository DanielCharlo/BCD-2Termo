-- Banco de Dados - Oficina Mecânica (Versão Simplificada)
DROP DATABASE IF EXISTS OFICINA;

CREATE DATABASE IF NOT EXISTS OFICINA;

USE OFICINA;

-- Tabelas
CREATE TABLE CLIENTE (
    ID_CLIENTE INT AUTO_INCREMENT PRIMARY KEY,
    NOME_CLIENTE VARCHAR(100) NOT NULL,
    TELEFONE_CLIENTE VARCHAR(20),
    DOCUMENTO VARCHAR(20),
    ENDERECO_CLIENTE VARCHAR(200),
    EMAIL VARCHAR(100)
);

CREATE TABLE VEICULO (
    ID_VEICULO INT AUTO_INCREMENT PRIMARY KEY,
    ID_CLIENTE INT NOT NULL,
    PLACA VARCHAR(10) NOT NULL,
    MARCA VARCHAR(50),
    MODELO VARCHAR(50),
    ANO INT,
    FOREIGN KEY (ID_CLIENTE) REFERENCES CLIENTE(ID_CLIENTE)
);

CREATE TABLE MECANICO (
    ID_MECANICO INT AUTO_INCREMENT PRIMARY KEY,
    NOME_MECANICO VARCHAR(100),
    ESPECIALIDADE VARCHAR(100),
    TELEFONE VARCHAR(20)
);

CREATE TABLE SERVICO (
    ID_SERVICO INT AUTO_INCREMENT PRIMARY KEY,
    NOME_SERVICO VARCHAR(100),
    VALOR_SERVICO DECIMAL(10,2)
);

CREATE TABLE PECA (
    ID_PECA INT AUTO_INCREMENT PRIMARY KEY,
    NOME_PECA VARCHAR(100),
    VALOR_PECA DECIMAL(10,2),
    QUANTIDADE_ESTOQUE INT DEFAULT 0
);

CREATE TABLE OS (
    ID_OS INT AUTO_INCREMENT PRIMARY KEY,
    ID_VEICULO INT NOT NULL,
    DATA_ABERTURA DATE,
    DATA_FECHAMENTO DATE,
    STATUS_OS VARCHAR(20),
    VALOR_TOTAL DECIMAL(10,2) DEFAULT 0,
    FOREIGN KEY (ID_VEICULO) REFERENCES VEICULO(ID_VEICULO)
);

CREATE TABLE OS_MECANICO (
    ID_OS_MECANICO INT AUTO_INCREMENT PRIMARY KEY,
    ID_OS INT NOT NULL,
    ID_MECANICO INT NOT NULL,
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS),
    FOREIGN KEY (ID_MECANICO) REFERENCES MECANICO(ID_MECANICO)
);

CREATE TABLE OS_SERVICO (
    ID_OS_SERVICO INT AUTO_INCREMENT PRIMARY KEY,
    ID_OS INT NOT NULL,
    ID_SERVICO INT NOT NULL,
    QUANTIDADE INT DEFAULT 1,
    VALOR_TOTAL DECIMAL(10,2),
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS),
    FOREIGN KEY (ID_SERVICO) REFERENCES SERVICO(ID_SERVICO)
);

CREATE TABLE OS_PECA (
    ID_OS_PECA INT AUTO_INCREMENT PRIMARY KEY,
    ID_OS INT NOT NULL,
    ID_PECA INT NOT NULL,
    QUANTIDADE INT DEFAULT 1,
    VALOR_TOTAL DECIMAL(10,2),
    FOREIGN KEY (ID_OS) REFERENCES OS(ID_OS),
    FOREIGN KEY (ID_PECA) REFERENCES PECA(ID_PECA)
);

-- Dados de exemplo
INSERT INTO CLIENTE (NOME_CLIENTE, TELEFONE_CLIENTE, DOCUMENTO, ENDERECO_CLIENTE) VALUES
('João Silva', '(11) 98765-4321', '123.456.789-00', 'Rua das Flores, 123'),
('Maria Santos', '(11) 97654-3210', '987.654.321-00', 'Av. Paulista, 1000'),
('Pedro Oliveira', '(11) 96543-2109', '456.789.123-00', 'Rua Augusta, 500'),
('Carlos Pereira', '(11) 95432-1098', '321.654.987-00', 'Av. Faria Lima, 500'),
('Ana Costa', '(11) 94321-0987', '789.123.456-00', 'Rua Consolação, 200'),
('Lucas Martins', '(11) 93210-9876', '654.321.789-00', 'Av. Brasil, 1500'),
('Fernanda Lima', '(11) 92109-8765', '147.258.369-00', 'Rua das Palmeiras, 300');

INSERT INTO VEICULO (ID_CLIENTE, PLACA, MARCA, MODELO, ANO) VALUES
(1, 'ABC-1234', 'Volkswagen', 'Gol', 2020),
(1, 'XYZ-5678', 'Fiat', 'Uno', 2018),
(2, 'DEF-9012', 'Ford', 'Ka', 2021),
(2, 'GHI-3456', 'Volkswagen', 'Polo', 2019),
(3, 'JKL-7890', 'Ford', 'Ranger', 2020),
(3, 'MNO-2468', 'Chevrolet', 'Onix', 2019),
(4, 'PQR-1357', 'Volkswagen', 'Fox', 2018),
(4, 'STU-9753', 'Fiat', 'Palio', 2020),
(5, 'VWX-8642', 'Ford', 'EcoSport', 2021),
(6, 'YZA-7410', 'Volkswagen', 'Voyage', 2019),
(7, 'BCD-8520', 'Fiat', 'Siena', 2020);

INSERT INTO MECANICO (NOME_MECANICO, ESPECIALIDADE, TELEFONE) VALUES
('Roberto Alves', 'Motor', '(11) 91234-5678'),
('Fernando Lima', 'Freios', '(11) 92345-6789'),
('Marcos Souza', 'Elétrica', '(11) 93456-7890'),
('Carlos Silva', 'Injeção Eletrônica', '(11) 94567-8901'),
('Paulo Costa', 'Motor', '(11) 95678-9012'),
('Ricardo Santos', 'Suspensão', '(11) 96789-0123'),
('José Oliveira', 'Ar Condicionado', '(11) 97890-1234');

INSERT INTO SERVICO (NOME_SERVICO, VALOR_SERVICO) VALUES
('Troca de Óleo', 80.00),
('Alinhamento', 120.00),
('Revisão Completa', 350.00),
('Troca de Pastilhas', 200.00),
('Reparo Motor', 500.00),
('Troca de Bateria', 150.00),
('Reparo de Freios', 300.00),
('Balanceamento', 100.00);

INSERT INTO PECA (NOME_PECA, VALOR_PECA, QUANTIDADE_ESTOQUE) VALUES
('Filtro de Óleo', 25.00, 50),
('Pastilha de Freio', 80.00, 30),
('Bateria 60Ah', 350.00, 15),
('Óleo Motor 5W30', 120.00, 40),
('Filtro de Ar', 35.00, 3),
('Vela de Ignição', 25.00, 2),
('Correia Dentada', 150.00, 8),
('Amortecedor Dianteiro', 280.00, 4),
('Fluido de Freio', 45.00, 12),
('Filtro de Combustível', 40.00, 6);

INSERT INTO OS (ID_VEICULO, DATA_ABERTURA, DATA_FECHAMENTO, STATUS_OS, VALOR_TOTAL) VALUES
(1, '2025-01-15', '2025-01-16', 'finalizada', 430.00),
(1, '2025-05-20', NULL, 'em_execucao', 320.00),
(1, '2025-09-10', '2025-09-12', 'finalizada', 600.00),
(2, '2025-01-20', '2025-01-22', 'finalizada', 680.00),
(2, '2025-06-10', NULL, 'em_execucao', 200.00),
(3, '2025-01-22', NULL, 'aberta', 80.00),
(3, '2025-03-15', '2025-03-18', 'finalizada', 850.00),
(4, '2025-07-15', NULL, 'em_execucao', 500.00),
(4, '2025-10-05', '2025-10-07', 'finalizada', 420.00),
(5, '2025-08-01', '2025-08-05', 'finalizada', 1200.00),
(5, '2025-11-10', NULL, 'em_execucao', 300.00),
(6, '2025-02-10', '2025-02-12', 'finalizada', 550.00),
(6, '2025-06-20', '2025-06-22', 'finalizada', 480.00),
(7, '2025-04-05', '2025-04-08', 'finalizada', 720.00),
(8, '2025-09-15', NULL, 'em_execucao', 250.00),
(9, '2025-07-20', '2025-07-23', 'finalizada', 950.00),
(10, '2025-05-10', '2025-05-12', 'finalizada', 380.00),
(11, '2025-08-15', NULL, 'aberta', 150.00);

INSERT INTO OS_MECANICO (ID_OS, ID_MECANICO) VALUES
(1, 1), (1, 2),
(2, 3),
(3, 1), (3, 2), (3, 4),
(4, 1), (4, 5),
(5, 2),
(6, 3),
(7, 1), (7, 3), (7, 4),
(8, 1),
(9, 2), (9, 6),
(10, 1), (10, 2), (10, 3),
(11, 4),
(12, 1), (12, 5),
(13, 2), (13, 3),
(14, 1), (14, 4), (14, 5),
(15, 2),
(16, 1), (16, 3), (16, 6),
(17, 2), (17, 5),
(18, 3);

INSERT INTO OS_SERVICO (ID_OS, ID_SERVICO, QUANTIDADE, VALOR_TOTAL) VALUES
(1, 3, 1, 350.00), (1, 1, 1, 80.00),
(2, 4, 1, 200.00), (2, 2, 1, 120.00),
(3, 3, 1, 350.00), (3, 1, 1, 80.00), (3, 2, 1, 120.00), (3, 5, 1, 500.00),
(4, 3, 1, 350.00), (4, 6, 1, 150.00), (4, 2, 1, 120.00),
(5, 4, 1, 200.00),
(6, 1, 1, 80.00),
(7, 3, 1, 350.00), (7, 5, 1, 500.00),
(8, 5, 1, 500.00),
(9, 3, 1, 350.00), (9, 1, 1, 80.00),
(10, 3, 1, 350.00), (10, 5, 1, 500.00), (10, 2, 1, 120.00),
(11, 7, 1, 300.00),
(12, 3, 1, 350.00), (12, 1, 1, 80.00), (12, 2, 1, 120.00),
(13, 3, 1, 350.00), (13, 1, 1, 80.00),
(14, 3, 1, 350.00), (14, 5, 1, 500.00),
(15, 4, 1, 200.00), (15, 8, 1, 100.00),
(16, 3, 1, 350.00), (16, 5, 1, 500.00), (16, 2, 1, 120.00),
(17, 1, 1, 80.00), (17, 2, 1, 120.00), (17, 8, 1, 100.00),
(18, 1, 1, 80.00), (18, 6, 1, 150.00);

INSERT INTO OS_PECA (ID_OS, ID_PECA, QUANTIDADE, VALOR_TOTAL) VALUES
(1, 1, 1, 25.00), (1, 4, 1, 120.00),
(2, 2, 2, 160.00),
(3, 1, 1, 25.00), (3, 4, 1, 120.00), (3, 7, 1, 150.00),
(4, 3, 1, 350.00), (4, 4, 1, 120.00),
(5, 2, 1, 80.00),
(6, 1, 1, 25.00), (6, 4, 1, 120.00),
(7, 2, 2, 160.00), (7, 9, 1, 45.00),
(8, 7, 1, 150.00),
(9, 1, 1, 25.00), (9, 4, 1, 120.00),
(10, 2, 4, 320.00), (10, 4, 2, 240.00), (10, 7, 1, 150.00),
(11, 2, 2, 160.00), (11, 9, 1, 45.00),
(12, 1, 1, 25.00), (12, 4, 1, 120.00), (12, 5, 1, 35.00),
(13, 1, 1, 25.00), (13, 4, 1, 120.00),
(14, 2, 3, 240.00), (14, 7, 1, 150.00),
(15, 2, 1, 80.00), (15, 9, 1, 45.00),
(16, 1, 2, 50.00), (16, 4, 2, 240.00), (16, 7, 1, 150.00),
(17, 1, 1, 25.00), (17, 4, 1, 120.00), (17, 10, 1, 40.00),
(18, 3, 1, 350.00);
