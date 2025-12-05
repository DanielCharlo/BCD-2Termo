<?php
require_once __DIR__ . '/../model/ServicoDAO.php';
require_once __DIR__ . '/../model/Servico.php';

class ServicoController {

    private $dao;

    public function __construct() {
        $this->dao = new ServicoDAO();
    }

    public function criar($nomeServico, $valorServico) {
        try {
            if (empty($nomeServico) || empty($valorServico)) {
                header("Location: indexS.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $s = new Servico($nomeServico, $valorServico);
            $this->dao->criar($s);
            header("Location: indexS.php?msg=sucesso");
        } catch (Exception $e) {
            header("Location: indexS.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function buscarPorId($id) {
        return $this->dao->buscarPorId($id);
    }

    public function atualizar($id, $nomeServico, $valorServico) {
        try {
            if (empty($id) || empty($nomeServico) || empty($valorServico)) {
                header("Location: indexS.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $s = new Servico($nomeServico, $valorServico, null, null, 'ativo', $id);
            $this->dao->atualizar($s);
            header("Location: indexS.php?msg=atualizado");
        } catch (Exception $e) {
            header("Location: indexS.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function deletar($id) {
        try {
            if (empty($id)) {
                header("Location: indexS.php?msg=erro&tipo=id_invalido");
                return;
            }
            
            $this->dao->deletar($id);
            header("Location: indexS.php?msg=deletado");
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
            if (strpos($mensagem, 'Integrity constraint') !== false) {
                $mensagem = "Não é possível excluir este serviço pois está sendo usado em ordens de serviço.";
            }
            header("Location: indexS.php?msg=erro&tipo=" . urlencode($mensagem));
        }
    }
}

