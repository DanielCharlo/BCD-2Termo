-- EXERCÍCIOS SQL - OFICINA MECÂNICA
USE OFICINA;

-- =====================================================
-- 1. SELECT (Consultas Básicas)
-- =====================================================

-- 1.1 Veículos da marca "Ford"
SELECT * FROM VEICULO WHERE MARCA = 'Ford';

-- 1.2 Clientes que abriram OS nos últimos 6 meses
SELECT DISTINCT c.* 
FROM CLIENTE c, VEICULO v, OS o
WHERE c.ID_CLIENTE = v.ID_CLIENTE 
AND v.ID_VEICULO = o.ID_VEICULO
AND o.DATA_ABERTURA >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH);

-- 1.3 Mecânicos com especialidade "Injeção Eletrônica"
SELECT * FROM MECANICO WHERE ESPECIALIDADE = 'Injeção Eletrônica';

-- 1.4 OS com status "em_execucao"
SELECT * FROM OS WHERE STATUS_OS = 'em_execucao';

-- 1.5 Peças com estoque abaixo de 5
SELECT * FROM PECA WHERE QUANTIDADE_ESTOQUE < 5;

-- 1.6 Veículos com mais de uma OS
SELECT v.*
FROM VEICULO v
WHERE (SELECT COUNT(*) FROM OS WHERE ID_VEICULO = v.ID_VEICULO) > 1;

-- 1.7 OS executadas pelo mecânico ID 3
SELECT o.*
FROM OS o, OS_MECANICO om
WHERE o.ID_OS = om.ID_OS AND om.ID_MECANICO = 3;

-- 1.8 Peças com valor maior que R$ 200
SELECT NOME_PECA, VALOR_PECA FROM PECA WHERE VALOR_PECA > 200;

-- =====================================================
-- 2. UPDATE
-- =====================================================

-- 2.1 Aumentar 5% no valor da peça ID 1
UPDATE PECA SET VALOR_PECA = VALOR_PECA * 1.05 WHERE ID_PECA = 1;

-- 2.2 Mudar status da OS 105 para finalizada
UPDATE OS SET STATUS_OS = 'finalizada' WHERE ID_OS = 105;

-- 2.3 Finalizar OS em execução há mais de 30 dias
-- Nota: Para funcionar no modo safe update, use IDs específicos ou desative o modo
UPDATE OS 
SET STATUS_OS = 'finalizada', DATA_FECHAMENTO = CURDATE()
WHERE ID_OS > 0
AND STATUS_OS = 'em_execucao' 
AND DATA_ABERTURA < DATE_SUB(CURDATE(), INTERVAL 30 DAY);

-- 2.4 Dobrar estoque da peça ID 20
UPDATE PECA SET QUANTIDADE_ESTOQUE = QUANTIDADE_ESTOQUE * 2 WHERE ID_PECA = 20;

-- =====================================================
-- 3. ALTER TABLE
-- =====================================================

-- 3.1 Adicionar coluna EMAIL
-- Nota: A coluna já existe no CREATE TABLE, então este comando dará erro
-- É apenas um exemplo de ALTER TABLE
-- ALTER TABLE CLIENTE ADD COLUMN EMAIL VARCHAR(100);

-- 3.2 Modificar ESPECIALIDADE
ALTER TABLE MECANICO MODIFY COLUMN ESPECIALIDADE VARCHAR(150);

-- 3.3 Remover coluna (exemplo - não existe)
-- ALTER TABLE OS DROP COLUMN DIAGNOSTICO_ENTRADA;

-- 3.4 Adicionar CHECK
-- Nota: Se der erro de constraint duplicada, significa que já foi criada antes
-- Execute apenas uma vez ou use um nome diferente
ALTER TABLE PECA ADD CONSTRAINT chk_valor_peca CHECK (VALOR_PECA >= 0);

-- =====================================================
-- 4. JOIN
-- =====================================================

-- 4.1 OS com nome do cliente, placa e data
SELECT o.ID_OS, c.NOME_CLIENTE, v.PLACA, o.DATA_ABERTURA
FROM OS o, VEICULO v, CLIENTE c
WHERE o.ID_VEICULO = v.ID_VEICULO AND v.ID_CLIENTE = c.ID_CLIENTE;

-- 4.2 Peças usadas na OS 50
SELECT p.NOME_PECA, op.QUANTIDADE
FROM OS_PECA op, PECA p
WHERE op.ID_PECA = p.ID_PECA AND op.ID_OS = 50;

-- 4.3 Mecânicos que trabalharam na OS 75
SELECT m.NOME_MECANICO
FROM OS_MECANICO om, MECANICO m
WHERE om.ID_MECANICO = m.ID_MECANICO AND om.ID_OS = 75;

-- 4.4 Veículos com nome do proprietário
SELECT v.PLACA, v.MODELO, c.NOME_CLIENTE
FROM VEICULO v, CLIENTE c
WHERE v.ID_CLIENTE = c.ID_CLIENTE;

-- =====================================================
-- 5. INNER JOIN
-- =====================================================

-- 5.1 Veículos com OS em execução
SELECT v.PLACA, v.MODELO
FROM VEICULO v
INNER JOIN OS o ON v.ID_VEICULO = o.ID_VEICULO
WHERE o.STATUS_OS = 'em_execucao';

-- 5.2 Clientes com veículos Volkswagen
SELECT DISTINCT c.NOME_CLIENTE
FROM CLIENTE c
INNER JOIN VEICULO v ON c.ID_CLIENTE = v.ID_CLIENTE
WHERE v.MARCA = 'Volkswagen';

-- 5.3 Mecânicos que trabalharam em OS
SELECT DISTINCT m.NOME_MECANICO
FROM MECANICO m
INNER JOIN OS_MECANICO om ON m.ID_MECANICO = om.ID_MECANICO;

-- 5.4 Serviços já executados
SELECT DISTINCT s.NOME_SERVICO
FROM SERVICO s
INNER JOIN OS_SERVICO os ON s.ID_SERVICO = os.ID_SERVICO;

-- =====================================================
-- 6. LEFT JOIN
-- =====================================================

-- 6.1 Todos os clientes e suas OS
SELECT c.NOME_CLIENTE, o.ID_OS
FROM CLIENTE c
LEFT JOIN VEICULO v ON c.ID_CLIENTE = v.ID_CLIENTE
LEFT JOIN OS o ON v.ID_VEICULO = o.ID_VEICULO;

-- 6.2 Mecânicos e quantidade de OS
SELECT m.NOME_MECANICO, COUNT(om.ID_OS) AS TOTAL_OS
FROM MECANICO m
LEFT JOIN OS_MECANICO om ON m.ID_MECANICO = om.ID_MECANICO
GROUP BY m.ID_MECANICO, m.NOME_MECANICO;

-- 6.3 Peças e quantidade vendida
SELECT p.NOME_PECA, IFNULL(SUM(op.QUANTIDADE), 0) AS VENDIDO
FROM PECA p
LEFT JOIN OS_PECA op ON p.ID_PECA = op.ID_PECA
GROUP BY p.ID_PECA, p.NOME_PECA;

-- 6.4 Veículos e última OS
SELECT v.PLACA, v.MODELO, MAX(o.DATA_ABERTURA) AS ULTIMA_OS
FROM VEICULO v
LEFT JOIN OS o ON v.ID_VEICULO = o.ID_VEICULO
GROUP BY v.ID_VEICULO, v.PLACA, v.MODELO;

-- =====================================================
-- 7. RIGHT JOIN
-- =====================================================

-- 7.1 OS e nome do cliente
SELECT o.ID_OS, c.NOME_CLIENTE
FROM OS o
RIGHT JOIN VEICULO v ON o.ID_VEICULO = v.ID_VEICULO
RIGHT JOIN CLIENTE c ON v.ID_CLIENTE = c.ID_CLIENTE;

-- 7.2 Serviços e OS onde foram usados
SELECT s.NOME_SERVICO, os.ID_OS
FROM OS_SERVICO os
RIGHT JOIN SERVICO s ON os.ID_SERVICO = s.ID_SERVICO;

-- 7.3 OS_MECANICO com nome do mecânico
SELECT om.*, m.NOME_MECANICO
FROM OS_MECANICO om
RIGHT JOIN MECANICO m ON om.ID_MECANICO = m.ID_MECANICO;

-- 7.4 Veículos e suas OS
SELECT v.*, o.ID_OS, o.DATA_ABERTURA
FROM OS o
RIGHT JOIN VEICULO v ON o.ID_VEICULO = v.ID_VEICULO;

-- =====================================================
-- 8. Subconsultas
-- =====================================================

-- 8.1 Clientes com mais de 3 OS
SELECT c.*
FROM CLIENTE c
WHERE (SELECT COUNT(*) FROM VEICULO v, OS o 
       WHERE v.ID_CLIENTE = c.ID_CLIENTE AND v.ID_VEICULO = o.ID_VEICULO) > 3;

-- 8.2 Peças usadas na mesma OS do mecânico ID 4
SELECT DISTINCT p.NOME_PECA
FROM PECA p, OS_PECA op
WHERE p.ID_PECA = op.ID_PECA 
AND op.ID_OS IN (SELECT ID_OS FROM OS_MECANICO WHERE ID_MECANICO = 4);

-- 8.3 Veículos sem OS
SELECT v.*
FROM VEICULO v
WHERE v.ID_VEICULO NOT IN (SELECT ID_VEICULO FROM OS WHERE ID_VEICULO IS NOT NULL);

-- 8.4 Serviços acima da média
SELECT s.*
FROM SERVICO s
WHERE s.VALOR_SERVICO > (SELECT AVG(VALOR_SERVICO) FROM SERVICO);

-- =====================================================
-- 9. Agregação
-- =====================================================

-- 9.1 Faturamento total da OS 100
SELECT IFNULL(SUM(os.VALOR_TOTAL), 0) + IFNULL(SUM(op.VALOR_TOTAL), 0) AS TOTAL
FROM OS o
LEFT JOIN OS_SERVICO os ON o.ID_OS = os.ID_OS
LEFT JOIN OS_PECA op ON o.ID_OS = op.ID_OS
WHERE o.ID_OS = 100;

-- 9.2 Tempo médio de OS (em dias)
SELECT AVG(DATEDIFF(IFNULL(DATA_FECHAMENTO, CURDATE()), DATA_ABERTURA)) AS MEDIA_DIAS
FROM OS
WHERE STATUS_OS = 'finalizada' OR DATA_FECHAMENTO IS NOT NULL;

-- 9.3 Total de veículos
SELECT COUNT(*) AS TOTAL FROM VEICULO;

-- 9.4 Valor total do inventário
SELECT SUM(QUANTIDADE_ESTOQUE * VALOR_PECA) AS TOTAL FROM PECA;

-- 9.5 Preço médio dos serviços
SELECT AVG(VALOR_SERVICO) AS MEDIA FROM SERVICO;

-- 9.6 Veículos por marca
SELECT MARCA, COUNT(*) AS QUANTIDADE FROM VEICULO GROUP BY MARCA;

-- 9.7 OS por mês
SELECT DATE_FORMAT(DATA_ABERTURA, '%Y-%m') AS MES, COUNT(*) AS TOTAL
FROM OS
GROUP BY MES
ORDER BY MES DESC;

-- 9.8 OS por status
SELECT STATUS_OS, COUNT(*) AS QUANTIDADE FROM OS GROUP BY STATUS_OS;

-- 9.9 Total de OS finalizadas
SELECT COUNT(*) AS TOTAL FROM OS WHERE STATUS_OS = 'finalizada';

-- 9.10 Faturamento Fiat no último ano
SELECT IFNULL(SUM(os.VALOR_TOTAL), 0) + IFNULL(SUM(op.VALOR_TOTAL), 0) AS TOTAL
FROM OS o
INNER JOIN VEICULO v ON o.ID_VEICULO = v.ID_VEICULO
LEFT JOIN OS_SERVICO os ON o.ID_OS = os.ID_OS
LEFT JOIN OS_PECA op ON o.ID_OS = op.ID_OS
WHERE v.MARCA = 'Fiat'
AND o.DATA_ABERTURA >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR);

-- 9.11 Preço médio serviços
SELECT AVG(VALOR_SERVICO) AS MEDIA FROM SERVICO;

-- 9.12 Clientes que gastaram mais de R$ 5000
SELECT c.ID_CLIENTE, c.NOME_CLIENTE, 
       IFNULL(SUM(os.VALOR_TOTAL), 0) + IFNULL(SUM(op.VALOR_TOTAL), 0) AS TOTAL
FROM CLIENTE c
INNER JOIN VEICULO v ON c.ID_CLIENTE = v.ID_CLIENTE
INNER JOIN OS o ON v.ID_VEICULO = o.ID_VEICULO
LEFT JOIN OS_SERVICO os ON o.ID_OS = os.ID_OS
LEFT JOIN OS_PECA op ON o.ID_OS = op.ID_OS
GROUP BY c.ID_CLIENTE, c.NOME_CLIENTE
HAVING TOTAL > 5000;

-- 9.13 Peças vendidas mais de 100 vezes
SELECT p.ID_PECA, p.NOME_PECA, SUM(op.QUANTIDADE) AS TOTAL
FROM PECA p, OS_PECA op
WHERE p.ID_PECA = op.ID_PECA
GROUP BY p.ID_PECA, p.NOME_PECA
HAVING TOTAL > 100;

-- 9.14 Especialidades com mais de 20 OS
SELECT m.ESPECIALIDADE, COUNT(DISTINCT om.ID_OS) AS TOTAL
FROM MECANICO m, OS_MECANICO om
WHERE m.ID_MECANICO = om.ID_MECANICO
GROUP BY m.ESPECIALIDADE
HAVING TOTAL > 20;

-- 9.15 Mecânico que mais trabalhou
SELECT m.NOME_MECANICO, COUNT(om.ID_OS) AS TOTAL
FROM MECANICO m, OS_MECANICO om
WHERE m.ID_MECANICO = om.ID_MECANICO
GROUP BY m.ID_MECANICO, m.NOME_MECANICO
ORDER BY TOTAL DESC
LIMIT 1;

-- =====================================================
-- 10. Indexação
-- =====================================================

-- 10.1 Índice na coluna PLACA
CREATE INDEX idx_placa ON VEICULO(PLACA);

-- 10.2 Índice na chave estrangeira
CREATE INDEX idx_os_veiculo ON OS(ID_VEICULO);

-- 10.3 Índice composto
CREATE INDEX idx_os_peca ON OS_PECA(ID_OS, ID_PECA);
