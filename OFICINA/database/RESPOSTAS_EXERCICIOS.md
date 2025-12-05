# Respostas dos Exercícios SQL - Oficina Mecânica

## Características de Banco de Dados Relacionais e Não-Relacionais

### Banco de Dados Relacional (MySQL)
- **Estrutura**: Dados organizados em tabelas (relações) com linhas e colunas
- **Integridade Referencial**: Chaves estrangeiras garantem consistência dos dados
- **ACID**: Transações garantem Atomicidade, Consistência, Isolamento e Durabilidade
- **SQL**: Linguagem padronizada para consultas e manipulação
- **Normalização**: Dados organizados para evitar redundância
- **Relacionamentos**: 1:1, 1:N, N:N através de chaves

### Banco Não-Relacional (NoSQL)
- **Estrutura Flexível**: Dados em formato JSON, documentos, chave-valor
- **Escalabilidade Horizontal**: Facilita distribuição em múltiplos servidores
- **Sem Schema Fixo**: Estrutura pode variar entre documentos
- **Performance**: Otimizado para leituras rápidas
- **Tipos**: MongoDB (documentos), Redis (chave-valor), Cassandra (colunas)

## 2. Configuração do Ambiente

O banco de dados foi configurado com:
- **MySQL/MariaDB** como SGBD relacional
- **Charset UTF8MB4** para suporte completo a caracteres especiais
- **Engine InnoDB** (padrão) para suporte a transações e foreign keys
- **Conexão PDO** no PHP para acesso seguro ao banco

## 3. Tipos de Dados Utilizados

- **INT**: IDs, anos, quantidades
- **VARCHAR(n)**: Textos de tamanho variável (nomes, endereços)
- **DECIMAL(10,2)**: Valores monetários com precisão de 2 casas decimais
- **DATE**: Datas (abertura, fechamento)
- **TIMESTAMP**: Data e hora automática
- **ENUM**: Valores pré-definidos (status)

## 4. Diagrama de Modelagem (MER)

```
CLIENTE (1) ────────< (N) VEICULO (1) ────────< (N) OS
                                                      │
                    ┌─────────────────────────────────┼─────────────────────┐
                    │                                 │                     │
                    ▼                                 ▼                     ▼
              MECANICO (N) ────< (N) OS_MECANICO     OS_SERVICO (N) ────< SERVICO (N)
                                                      │
                                                      │
                                              OS_PECA (N) ────< (N) PECA
```

## 5. Relacionamentos entre Tabelas

- **CLIENTE → VEICULO**: 1:N (Um cliente pode ter vários veículos)
- **VEICULO → OS**: 1:N (Um veículo pode ter várias OS)
- **OS ↔ MECANICO**: N:N (Tabela intermediária OS_MECANICO)
- **OS ↔ SERVICO**: N:N (Tabela intermediária OS_SERVICO)
- **OS ↔ PECA**: N:N (Tabela intermediária OS_PECA)

## 6. Linguagem de Definição de Dados (DDL)

Exemplos utilizados:
- `CREATE DATABASE`: Criação do banco
- `CREATE TABLE`: Criação de tabelas
- `ALTER TABLE`: Modificação de estrutura
- `CREATE INDEX`: Criação de índices
- `FOREIGN KEY`: Definição de relacionamentos

## 7. Linguagem de Manipulação de Dados (DML)

Exemplos utilizados:
- `SELECT`: Consultas de dados
- `INSERT`: Inserção de registros
- `UPDATE`: Atualização de dados
- `DELETE`: Exclusão de registros

## 8. Funções Nativas do Banco de Dados

### Funções de Data
- `CURDATE()`: Data atual
- `DATE_SUB()`: Subtração de datas
- `DATEDIFF()`: Diferença entre datas
- `DATE_FORMAT()`: Formatação de datas

### Funções de Agregação
- `COUNT()`: Contagem de registros
- `SUM()`: Soma de valores
- `AVG()`: Média de valores
- `MAX()`: Valor máximo
- `MIN()`: Valor mínimo

### Funções de String
- `COALESCE()`: Retorna primeiro valor não-nulo
- `LIKE`: Busca com padrões

### Funções Matemáticas
- Operações aritméticas: `*`, `+`, `-`, `/`

## Observações Importantes

1. **Adaptações**: Algumas consultas foram adaptadas para o banco simplificado criado
2. **Nomenclatura**: Todas as tabelas e colunas estão em MAIÚSCULAS conforme o banco criado
3. **Status**: Valores de status foram adaptados para os existentes no banco (aberta, em_execucao, finalizada, cancelada)
4. **Campos Opcionais**: Alguns campos mencionados nos exercícios não existem no banco simplificado e foram adaptados

## Como Usar

Execute o arquivo `exercicios_sql.sql` no MySQL para ver todas as consultas funcionando:

```bash
mysql -u root -p OFICINA < database/exercicios_sql.sql
```

Ou execute as consultas individualmente no MySQL Workbench ou phpMyAdmin.

