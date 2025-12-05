<?php
require_once __DIR__ . '/../model/ClienteDAO.php';
require_once __DIR__ . '/../model/Cliente.php';

class ClienteController {

    private $dao;

    public function __construct() {
        $this->dao = new ClienteDAO();
    }

    public function criar($nome, $telefone, $documento, $endereco) {
        try {
            // Validação básica
            if (empty($nome) || empty($telefone) || empty($documento) || empty($endereco)) {
                header("Location: indexC.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $c = new Cliente($nome, $telefone, $documento, $endereco);
            $this->dao->criar($c);
            header("Location: indexC.php?msg=sucesso");
        } catch (Exception $e) {
            header("Location: indexC.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function deletar($id) {
        try {
            if (empty($id)) {
                header("Location: indexC.php?msg=erro&tipo=id_invalido");
                return;
            }
            
            $this->dao->deletar($id);
            header("Location: indexC.php?msg=deletado");
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
            // Melhorar mensagem de erro para o usuário
            if (strpos($mensagem, 'Integrity constraint') !== false) {
                $mensagem = "Não é possível excluir este cliente pois existem registros relacionados (veículos ou ordens de serviço).";
            }
            header("Location: indexC.php?msg=erro&tipo=" . urlencode($mensagem));
        }
    }

    public function atualizar($id, $nome, $telefone, $documento, $endereco) {
        try {
            // Validação básica
            if (empty($id) || empty($nome) || empty($telefone) || empty($documento) || empty($endereco)) {
                header("Location: indexC.php?msg=erro&tipo=campos_vazios");
                return;
            }
            
            $c = new Cliente($nome, $telefone, $documento, $endereco, $id);
            $this->dao->atualizar($c);
            header("Location: indexC.php?msg=atualizado");
        } catch (Exception $e) {
            header("Location: indexC.php?msg=erro&tipo=" . urlencode($e->getMessage()));
        }
    }
}
