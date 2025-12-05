<?php
require_once __DIR__ . '/../model/VeiculoDAO.php';
require_once __DIR__ . '/../model/Veiculo.php';

class VeiculoController {

    private $dao;

    public function __construct() {
        $this->dao = new VeiculoDAO();
    }

    public function criar($idCliente, $placa, $marca, $modelo, $ano) {
        try {
            if (empty($idCliente) || empty($placa) || empty($marca) || empty($modelo) || empty($ano)) {
                header("Location: indexV.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $v = new Veiculo($idCliente, $placa, $marca, $modelo, $ano);
            $this->dao->criar($v);
            header("Location: indexV.php?msg=sucesso");
        } catch (Exception $e) {
            header("Location: indexV.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function buscarPorId($id) {
        return $this->dao->buscarPorId($id);
    }

    public function atualizar($id, $idCliente, $placa, $marca, $modelo, $ano) {
        try {
            if (empty($id) || empty($idCliente) || empty($placa) || empty($marca) || empty($modelo) || empty($ano)) {
                header("Location: indexV.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $v = new Veiculo($idCliente, $placa, $marca, $modelo, $ano, null, null, null, $id);
            $this->dao->atualizar($v);
            header("Location: indexV.php?msg=atualizado");
        } catch (Exception $e) {
            header("Location: indexV.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function deletar($id) {
        try {
            if (empty($id)) {
                header("Location: indexV.php?msg=erro&tipo=id_invalido");
                return;
            }
            
            $this->dao->deletar($id);
            header("Location: indexV.php?msg=deletado");
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
            if (strpos($mensagem, 'Integrity constraint') !== false) {
                $mensagem = "Não é possível excluir este veículo pois existem ordens de serviço associadas.";
            }
            header("Location: indexV.php?msg=erro&tipo=" . urlencode($mensagem));
        }
    }
}

