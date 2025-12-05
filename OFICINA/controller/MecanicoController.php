<?php
require_once __DIR__ . '/../model/MecanicoDAO.php';
require_once __DIR__ . '/../model/Mecanico.php';

class MecanicoController {
    private $dao;

    public function __construct(){
        $this->dao = new MecanicoDAO();
    }

    public function criar($nome, $esp, $tel, $status='ativo'){
        try {
            if (empty($nome) || empty($esp) || empty($tel)) {
                header("Location: IndexM.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $m = new Mecanico($nome, $esp, $tel, $status);
            $this->dao->criar($m);
            header("Location: IndexM.php?msg=sucesso");
        } catch (Exception $e) {
            header("Location: IndexM.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function ler(){
        return $this->dao->ler();
    }

    public function buscarPorId($id){
        return $this->dao->buscarPorId($id);
    }

    public function editar($id, $nome, $esp, $tel){
        try {
            if (empty($id) || empty($nome) || empty($esp) || empty($tel)) {
                header("Location: IndexM.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $m = new Mecanico($nome, $esp, $tel, 'ativo', $id);
            $this->dao->editar($m);
            header("Location: IndexM.php?msg=atualizado");
        } catch (Exception $e) {
            header("Location: IndexM.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function deletar($id){
        try {
            if (empty($id)) {
                header("Location: IndexM.php?msg=erro&tipo=id_invalido");
                return;
            }
            
            $this->dao->deletar($id);
            header("Location: IndexM.php?msg=deletado");
        } catch (Exception $e) {
            header("Location: IndexM.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }
}
?>
