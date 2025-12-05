<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Cliente.php';

class ClienteDAO {


    public function criar(Cliente $c) {
        try {
            $sql = "INSERT INTO CLIENTE (NOME_CLIENTE, TELEFONE_CLIENTE, DOCUMENTO, ENDERECO_CLIENTE)
                    VALUES (?, ?, ?, ?)";

            $stmt = Connection::getInstance()->prepare($sql);
            return $stmt->execute([
                $c->getNome(),
                $c->getTelefone(),
                $c->getDocumento(),
                $c->getEndereco()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar cliente: " . $e->getMessage());
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM CLIENTE";
            $stmt = Connection::getInstance()->query($sql);

            $lista = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lista[] = new Cliente(
                    $row['NOME_CLIENTE'],
                    $row['TELEFONE_CLIENTE'],
                    $row['DOCUMENTO'],
                    $row['ENDERECO_CLIENTE'],
                    $row['ID_CLIENTE']
                );
            }

            return $lista;
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar clientes: " . $e->getMessage());
        }
    }

    public function deletar($id) {
        try {
            $conn = Connection::getInstance();
            $conn->beginTransaction();
            
            // Buscar todos os veículos do cliente
            $sqlVeiculos = "SELECT ID_VEICULO FROM VEICULO WHERE ID_CLIENTE = ?";
            $stmtVeiculos = $conn->prepare($sqlVeiculos);
            $stmtVeiculos->execute([$id]);
            $veiculos = $stmtVeiculos->fetchAll(PDO::FETCH_ASSOC);
            
            // Para cada veículo, deletar as OS e seus relacionamentos
            foreach ($veiculos as $veiculo) {
                $idVeiculo = $veiculo['ID_VEICULO'];
                
                // Buscar todas as OS do veículo
                $sqlOS = "SELECT ID_OS FROM OS WHERE ID_VEICULO = ?";
                $stmtOS = $conn->prepare($sqlOS);
                $stmtOS->execute([$idVeiculo]);
                $osList = $stmtOS->fetchAll(PDO::FETCH_ASSOC);
                
                // Para cada OS, deletar relacionamentos
                foreach ($osList as $os) {
                    $idOS = $os['ID_OS'];
                    
                    // Deletar OS_PECA
                    $sqlDeleteOSPeca = "DELETE FROM OS_PECA WHERE ID_OS = ?";
                    $stmtDeleteOSPeca = $conn->prepare($sqlDeleteOSPeca);
                    $stmtDeleteOSPeca->execute([$idOS]);
                    
                    // Deletar OS_SERVICO
                    $sqlDeleteOSServico = "DELETE FROM OS_SERVICO WHERE ID_OS = ?";
                    $stmtDeleteOSServico = $conn->prepare($sqlDeleteOSServico);
                    $stmtDeleteOSServico->execute([$idOS]);
                    
                    // Deletar OS_MECANICO
                    $sqlDeleteOSMecanico = "DELETE FROM OS_MECANICO WHERE ID_OS = ?";
                    $stmtDeleteOSMecanico = $conn->prepare($sqlDeleteOSMecanico);
                    $stmtDeleteOSMecanico->execute([$idOS]);
                }
                
                // Deletar todas as OS do veículo
                if (!empty($osList)) {
                    $sqlDeleteOS = "DELETE FROM OS WHERE ID_VEICULO = ?";
                    $stmtDeleteOS = $conn->prepare($sqlDeleteOS);
                    $stmtDeleteOS->execute([$idVeiculo]);
                }
            }
            
            // Deletar todos os veículos do cliente
            if (!empty($veiculos)) {
                $sqlDeleteVeiculos = "DELETE FROM VEICULO WHERE ID_CLIENTE = ?";
                $stmtDeleteVeiculos = $conn->prepare($sqlDeleteVeiculos);
                $stmtDeleteVeiculos->execute([$id]);
            }
            
            // Por fim, deletar o cliente
            $sql = "DELETE FROM CLIENTE WHERE ID_CLIENTE = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            if (isset($conn)) {
                $conn->rollBack();
            }
            throw new Exception("Erro ao deletar cliente: " . $e->getMessage());
        }
    }

    public function atualizar(Cliente $c) {
        try {
            $sql = "UPDATE CLIENTE SET 
                    NOME_CLIENTE = ?, TELEFONE_CLIENTE = ?, DOCUMENTO = ?, ENDERECO_CLIENTE = ?
                    WHERE ID_CLIENTE = ?";

            $stmt = Connection::getInstance()->prepare($sql);

            return $stmt->execute([
                $c->getNome(),
                $c->getTelefone(),
                $c->getDocumento(),
                $c->getEndereco(),
                $c->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar cliente: " . $e->getMessage());
        }
    }
}
