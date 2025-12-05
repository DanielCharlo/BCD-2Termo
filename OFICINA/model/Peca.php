<?php

class Peca {
    private $id;
    private $nomePeca;
    private $descricao;
    private $valorPeca;
    private $quantidadeEstoque;
    private $quantidadeMinima;
    private $fornecedor;
    private $statusPeca;

    public function __construct($nomePeca, $valorPeca, $quantidadeEstoque = 0, $quantidadeMinima = 5, $fornecedor = null, $descricao = null, $statusPeca = 'ativo', $id = null) {
        $this->id = $id;
        $this->nomePeca = $nomePeca;
        $this->descricao = $descricao;
        $this->valorPeca = $valorPeca;
        $this->quantidadeEstoque = $quantidadeEstoque;
        $this->quantidadeMinima = $quantidadeMinima;
        $this->fornecedor = $fornecedor;
        $this->statusPeca = $statusPeca;
    }

    public function getId() { return $this->id; }
    public function getNomePeca() { return $this->nomePeca; }
    public function getDescricao() { return $this->descricao; }
    public function getValorPeca() { return $this->valorPeca; }
    public function getQuantidadeEstoque() { return $this->quantidadeEstoque; }
    public function getQuantidadeMinima() { return $this->quantidadeMinima; }
    public function getFornecedor() { return $this->fornecedor; }
    public function getStatusPeca() { return $this->statusPeca; }

    public function setId($id) { $this->id = $id; return $this; }
    public function setNomePeca($nomePeca) { $this->nomePeca = $nomePeca; return $this; }
    public function setDescricao($descricao) { $this->descricao = $descricao; return $this; }
    public function setValorPeca($valorPeca) { $this->valorPeca = $valorPeca; return $this; }
    public function setQuantidadeEstoque($quantidadeEstoque) { $this->quantidadeEstoque = $quantidadeEstoque; return $this; }
    public function setQuantidadeMinima($quantidadeMinima) { $this->quantidadeMinima = $quantidadeMinima; return $this; }
    public function setFornecedor($fornecedor) { $this->fornecedor = $fornecedor; return $this; }
    public function setStatusPeca($statusPeca) { $this->statusPeca = $statusPeca; return $this; }
}

