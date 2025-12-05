<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Veiculo.php';

class VeiculoDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();
    }

    public function criar(Veiculo $v) {
        try {
            $sql = "INSERT INTO VEICULO (ID_CLIENTE, PLACA, MARCA, MODELO, ANO)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $v->getIdCliente(),
                $v->getPlaca(),
                $v->getMarca(),
                $v->getModelo(),
                $v->getAno()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar veículo: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM VEICULO ORDER BY ID_VEICULO DESC";
            $stmt = $this->conn->query($sql);

            $lista = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Veiculo(
                    $row['ID_CLIENTE'],
                    $row['PLACA'],
                    $row['MARCA'],
                    $row['MODELO'],
                    $row['ANO'],
                    null,
                    null,
                    null,
                    $row['ID_VEICULO']
                );
            }

            return $lista;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar veículos: " . $e->getMessage());
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM VEICULO WHERE ID_VEICULO = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) return null;

            return new Veiculo(
                $row['ID_CLIENTE'],
                $row['PLACA'],
                $row['MARCA'],
                $row['MODELO'],
                $row['ANO'],
                $row['COR'],
                $row['CHASSI'],
                $row['DATA_CADASTRO'],
                $row['ID_VEICULO']
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar veículo: " . $e->getMessage());
        }
    }

    public function buscarPorCliente($idCliente) {
        try {
            $sql = "SELECT * FROM VEICULO WHERE ID_CLIENTE = ? ORDER BY PLACA";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idCliente]);

            $lista = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Veiculo(
                    $row['ID_CLIENTE'],
                    $row['PLACA'],
                    $row['MARCA'],
                    $row['MODELO'],
                    $row['ANO'],
                    null,
                    null,
                    null,
                    $row['ID_VEICULO']
                );
            }

            return $lista;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar veículos do cliente: " . $e->getMessage());
        }
    }

    public function atualizar(Veiculo $v) {
        try {
            $sql = "UPDATE VEICULO SET 
                    ID_CLIENTE = ?, PLACA = ?, MARCA = ?, MODELO = ?, ANO = ?
                    WHERE ID_VEICULO = ?";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $v->getIdCliente(),
                $v->getPlaca(),
                $v->getMarca(),
                $v->getModelo(),
                $v->getAno(),
                $v->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar veículo: " . $e->getMessage());
        }
    }

    public function deletar($id) {
        try {
            $sql = "DELETE FROM VEICULO WHERE ID_VEICULO = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao deletar veículo: " . $e->getMessage());
        }
    }
}

