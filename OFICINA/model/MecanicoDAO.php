<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Mecanico.php';

class MecanicoDAO {
    private $conn;

    public function __construct(){
        $this->conn = Connection::getInstance();
    }

    public function criar(Mecanico $m){
        $stmt = $this->conn->prepare("
            INSERT INTO MECANICO (NOME_MECANICO, ESPECIALIDADE, TELEFONE)
            VALUES (:nome, :esp, :tel)
        ");

        $stmt->execute([
            ':nome' => $m->getNome(),
            ':esp'  => $m->getEspecialidade(),
            ':tel'  => $m->getTelefone()
        ]);
    }

    public function ler(){
        $stmt = $this->conn->query("SELECT * FROM MECANICO ORDER BY ID_MECANICO DESC");

        $lista = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lista[] = new Mecanico(
                $row['NOME_MECANICO'],
                $row['ESPECIALIDADE'],
                $row['TELEFONE'],
                'ativo',
                $row['ID_MECANICO']
            );
        }
        return $lista;
    }

    public function buscarPorId($id){
        $stmt = $this->conn->prepare("SELECT * FROM MECANICO WHERE ID_MECANICO = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row) return null;

        return new Mecanico(
            $row['NOME_MECANICO'],
            $row['ESPECIALIDADE'],
            $row['TELEFONE'],
            'ativo',
            $row['ID_MECANICO']
        );
    }

    public function editar(Mecanico $m){
        $stmt = $this->conn->prepare("
            UPDATE MECANICO SET
                NOME_MECANICO = ?,
                ESPECIALIDADE = ?,
                TELEFONE = ?
            WHERE ID_MECANICO = ?
        ");

        $stmt->execute([
            $m->getNome(),
            $m->getEspecialidade(),
            $m->getTelefone(),
            $m->getId()
        ]);
    }

    public function deletar($id){
        $stmt = $this->conn->prepare("DELETE FROM MECANICO WHERE ID_MECANICO = ?");
        $stmt->execute([$id]);
    }
}
?>
