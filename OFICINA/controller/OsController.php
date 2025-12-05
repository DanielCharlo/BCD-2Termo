<?php
require_once __DIR__ . '/../model/OsDAO.php';
require_once __DIR__ . '/../model/Os.php';

class OsController {

    private $dao;

    public function __construct() {
        $this->dao = new OsDAO();
    }

    public function criar($data, $status, $idVeiculo){
        try {
            if (empty($data) || empty($status) || empty($idVeiculo)) {
                header("Location: indexOS.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $os = new OS($data, $status, $idVeiculo);
            $this->dao->criar($os);
            header("Location: indexOS.php?msg=sucesso");
        } catch (Exception $e) {
            header("Location: indexOS.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function atualizar($id, $data, $status, $idVeiculo){
        try {
            if (empty($id) || empty($data) || empty($status) || empty($idVeiculo)) {
                header("Location: indexOS.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $os = new OS($data, $status, $idVeiculo, null, $id);
            $this->dao->atualizar($os);
            header("Location: indexOS.php?msg=atualizado");
        } catch (Exception $e) {
            header("Location: indexOS.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function ler(){
        return $this->dao->ler();
    }

    public function buscarPorId($id){
        return $this->dao->buscarPorId($id);
    }

    public function excluir($id){
        try {
            if (empty($id)) {
                header("Location: indexOS.php?msg=erro&tipo=id_invalido");
                return;
            }
            
            $this->dao->excluir($id);
            header("Location: indexOS.php?msg=deletado");
        } catch (Exception $e) {
            header("Location: indexOS.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }
}
?>
