<?php
class Mecanico {
    private $id, $nome, $especialidade, $telefone, $status;

    public function __construct($nome, $especialidade, $telefone, $status='ativo', $id=null){
        $this->id = $id;
        $this->nome = $nome;
        $this->especialidade = $especialidade;
        $this->telefone = $telefone;
        $this->status = $status;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getEspecialidade() { return $this->especialidade; }
    public function getTelefone() { return $this->telefone; }
    public function getStatus() { return $this->status; }

    public function setNome($nome){ $this->nome=$nome; return $this; }
    public function setEspecialidade($esp){ $this->especialidade=$esp; return $this; }
    public function setTelefone($tel){ $this->telefone=$tel; return $this; }
    public function setStatus($status){ $this->status=$status; return $this; }
}
?>
