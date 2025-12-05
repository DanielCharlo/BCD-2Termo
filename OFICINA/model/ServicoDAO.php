<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Servico.php';

class ServicoDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();
    }

    public function criar(Servico $s) {
        try {
            $sql = "INSERT INTO SERVICO (NOME_SERVICO, VALOR_SERVICO)
                    VALUES (?, ?)";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $s->getNomeServico(),
                $s->getValorServico()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar serviço: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM SERVICO ORDER BY NOME_SERVICO";
            $stmt = $this->conn->query($sql);

            $lista = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Servico(
                    $row['NOME_SERVICO'],
                    $row['VALOR_SERVICO'],
                    null,
                    null,
                    'ativo',
                    $row['ID_SERVICO']
                );
            }

            return $lista;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar serviços: " . $e->getMessage());
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM SERVICO WHERE ID_SERVICO = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) return null;

            return new Servico(
                $row['NOME_SERVICO'],
                $row['VALOR_SERVICO'],
                null,
                null,
                'ativo',
                $row['ID_SERVICO']
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar serviço: " . $e->getMessage());
        }
    }

    public function atualizar(Servico $s) {
        try {
            $sql = "UPDATE SERVICO SET 
                    NOME_SERVICO = ?, VALOR_SERVICO = ?
                    WHERE ID_SERVICO = ?";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $s->getNomeServico(),
                $s->getValorServico(),
                $s->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar serviço: " . $e->getMessage());
        }
    }

    public function deletar($id) {
        try {
            $sql = "DELETE FROM SERVICO WHERE ID_SERVICO = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar serviço: " . $e->getMessage());
        }
    }
}

