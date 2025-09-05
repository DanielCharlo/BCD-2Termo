use ATIVIDADE_AVALIATIVA;
show tables;
show create table fornecedor;
select * from cidade;

INSERT INTO cidade (Cnome, uf) values ('Limeira', 'SP');
INSERT INTO cidade (Cnome, uf) values ('Ribeirao Preto', 'SP'),('Iracemapolis','SP');
INSERT INTO cidade (Ccod,Cnome, uf) values (10,'Rio Claro', 'SP');
INSERT INTO cidade (Ccod,Cnome, uf) values (5,'Mogi das cruzes', 'SP');

SELECT last_insert_id();

SELECT * FROM fornecedor;

INSERT INTO fornecedor (Fnome,Status,cidade,fone,Ccod) values ('Otavio','Ativo','Limeira','(19)99812-1125',1);
INSERT INTO fornecedor (Fnome,Status,cidade,fone,Ccod) values ('Charlo','Ativo','Mogi das cruzes','(19)99863-2085',5);

SELECT * FROM peca;

INSERT INTO peca (Pnome, Cor, Peso, Ccod) VALUES ('Para-choque','Preto',50.0,2);
INSERT INTO peca (Pnome, Cor, Peso, Ccod) VALUES ('Pneu','Preto',10.0,3);

Select * from projeto;

INSERT INTO projeto (PRnome, Ccod) VALUES ('Corsa',2) , ('Celta',5);

Select * from fornecimento;

INSERT INTO fornecimento(Fcod,Pcod,Prcod,Quantidade) VALUES (1,2,1,10),(3,1,2,20);