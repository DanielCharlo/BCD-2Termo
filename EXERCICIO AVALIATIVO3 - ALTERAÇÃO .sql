USE ATIVIDADE_AVALIATIVA;

ALTER TABLE projeto DROP FOREIGN KEY projeto_ibfk_1;
ALTER TABLE projeto DROP COLUMN Icod;

CREATE TABLE cidade (
  Ccod INT PRIMARY KEY AUTO_INCREMENT,
  Cnome VARCHAR(100) NOT NULL,
  uf CHAR(2) NOT NULL
);

ALTER TABLE fornecedor 
  ADD fone VARCHAR(20),
  ADD Ccod INT,
  ADD CONSTRAINT fk_fornecedor_cidade FOREIGN KEY (Ccod) REFERENCES Cidade(Ccod);

ALTER TABLE peca DROP COLUMN cidade;
ALTER TABLE peca 
  ADD Ccod INT,
  ADD CONSTRAINT fk_peca_cidade FOREIGN KEY (Ccod) REFERENCES cidade(Ccod);

ALTER TABLE projeto DROP COLUMN cidade;
ALTER TABLE projeto 
  ADD Ccod INT,
  ADD CONSTRAINT fk_projeto_cidade FOREIGN KEY (Ccod) REFERENCES cidade(Ccod);

DROP TABLE instituicao;
