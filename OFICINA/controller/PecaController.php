<?php
require_once __DIR__ . '/../model/PecaDAO.php';
require_once __DIR__ . '/../model/Peca.php';

class PecaController {

    private $dao;

    public function __construct() {
        $this->dao = new PecaDAO();
    }

    public function criar($nomePeca, $valorPeca, $quantidadeEstoque) {
        try {
            if (empty($nomePeca) || empty($valorPeca) || $quantidadeEstoque < 0) {
                header("Location: indexP.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $p = new Peca($nomePeca, $valorPeca, $quantidadeEstoque);
            $this->dao->criar($p);
            header("Location: indexP.php?msg=sucesso");
        } catch (Exception $e) {
            header("Location: indexP.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function buscarPorId($id) {
        return $this->dao->buscarPorId($id);
    }

    public function atualizar($id, $nomePeca, $valorPeca, $quantidadeEstoque) {
        try {
            if (empty($id) || empty($nomePeca) || empty($valorPeca) || $quantidadeEstoque < 0) {
                header("Location: indexP.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $p = new Peca($nomePeca, $valorPeca, $quantidadeEstoque, 0, null, null, 'ativo', $id);
            $this->dao->atualizar($p);
            header("Location: indexP.php?msg=atualizado");
        } catch (Exception $e) {
            header("Location: indexP.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function deletar($id) {
        try {
            if (empty($id)) {
                header("Location: indexP.php?msg=erro&tipo=id_invalido");
                return;
            }
            
            $this->dao->deletar($id);
            header("Location: indexP.php?msg=deletado");
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
            if (strpos($mensagem, 'Integrity constraint') !== false) {
                $mensagem = "Não é possível excluir esta peça pois está sendo usada em ordens de serviço.";
            }
            header("Location: indexP.php?msg=erro&tipo=" . urlencode($mensagem));
        }
    }
}

