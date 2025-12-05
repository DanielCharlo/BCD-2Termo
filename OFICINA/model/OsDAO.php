<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Os.php';

class OsDAO {
    private $conn;

    public function __construct(){
        $this->conn = Connection::getInstance();
    }

    public function criar(OS $os){
        $stmt = $this->conn->prepare("
            INSERT INTO OS (DATA_ABERTURA, STATUS_OS, ID_VEICULO)
            VALUES (:ab, :status, :veic)
        ");

        $stmt->execute([
            ':ab' => $os->getDataAbertura(),
            ':status' => $os->getStatus(),
            ':veic' => $os->getIdVeiculo()
        ]);
    }

    public function ler(){
        $stmt = $this->conn->query("SELECT * FROM OS");
        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = new OS(
                $row['DATA_ABERTURA'],
                $row['STATUS_OS'],
                $row['ID_VEICULO'],
                null,
                $row['ID_OS']
            );
        }

        return $result;
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM OS WHERE ID_OS = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) return null;

            return new OS(
                $row['DATA_ABERTURA'],
                $row['STATUS_OS'],
                $row['ID_VEICULO'],
                null,
                $row['ID_OS']
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar OS: " . $e->getMessage());
        }
    }

    public function atualizar(OS $os) {
        try {
            $sql = "UPDATE OS SET 
                    DATA_ABERTURA = ?, STATUS_OS = ?, ID_VEICULO = ?
                    WHERE ID_OS = ?";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $os->getDataAbertura(),
                $os->getStatus(),
                $os->getIdVeiculo(),
                $os->getId()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar OS: " . $e->getMessage());
        }
    }

    public function excluir($id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM OS WHERE ID_OS = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir OS: " . $e->getMessage());
        }
    }
}
?>
