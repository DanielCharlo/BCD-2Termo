<?php

class Cliente {
    private $id;
    private $nome;
    private $telefone;
    private $documento;
    private $endereco;

    public function __construct($nome, $telefone, $documento, $endereco, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->documento = $documento;
        $this->endereco = $endereco;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getTelefone() { return $this->telefone; }
    public function getDocumento() { return $this->documento; }
    public function getEndereco() { return $this->endereco; }
}
