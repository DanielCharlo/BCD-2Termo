<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Peca.php';

class PecaDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();
    }

    public function criar(Peca $p) {
        try {
            $sql = "INSERT INTO PECA (NOME_PECA, VALOR_PECA, QUANTIDADE_ESTOQUE)
                    VALUES (?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $p->getNomePeca(),
                $p->getValorPeca(),
                $p->getQuantidadeEstoque()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar peça: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM PECA ORDER BY NOME_PECA";
            $stmt = $this->conn->query($sql);

            $lista = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Peca(
                    $row['NOME_PECA'],
                    $row['VALOR_PECA'],
                    $row['QUANTIDADE_ESTOQUE'],
                    0,
                    null,
                    null,
                    'ativo',
                    $row['ID_PECA']
                );
            }

            return $lista;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar peças: " . $e->getMessage());
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM PECA WHERE ID_PECA = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) return null;

            return new Peca(
                $row['NOME_PECA'],
                $row['VALOR_PECA'],
                $row['QUANTIDADE_ESTOQUE'],
                0,
                null,
                null,
                'ativo',
                $row['ID_PECA']
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar peça: " . $e->getMessage());
        }
    }

    public function atualizar(Peca $p) {
        try {
            $sql = "UPDATE PECA SET 
                    NOME_PECA = ?, VALOR_PECA = ?, QUANTIDADE_ESTOQUE = ?
                    WHERE ID_PECA = ?";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $p->getNomePeca(),
                $p->getValorPeca(),
                $p->getQuantidadeEstoque(),
                $p->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar peça: " . $e->getMessage());
        }
    }

    public function deletar($id) {
        try {
            $sql = "DELETE FROM PECA WHERE ID_PECA = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar peça: " . $e->getMessage());
        }
    }
}

