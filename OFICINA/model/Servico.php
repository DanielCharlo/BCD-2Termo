<?php

class Servico {
    private $id;
    private $nomeServico;
    private $descricao;
    private $valorServico;
    private $tempoEstimado;
    private $statusServico;

    public function __construct($nomeServico, $valorServico, $tempoEstimado = null, $descricao = null, $statusServico = 'ativo', $id = null) {
        $this->id = $id;
        $this->nomeServico = $nomeServico;
        $this->descricao = $descricao;
        $this->valorServico = $valorServico;
        $this->tempoEstimado = $tempoEstimado;
        $this->statusServico = $statusServico;
    }

    public function getId() { return $this->id; }
    public function getNomeServico() { return $this->nomeServico; }
    public function getDescricao() { return $this->descricao; }
    public function getValorServico() { return $this->valorServico; }
    public function getTempoEstimado() { return $this->tempoEstimado; }
    public function getStatusServico() { return $this->statusServico; }

    public function setId($id) { $this->id = $id; return $this; }
    public function setNomeServico($nomeServico) { $this->nomeServico = $nomeServico; return $this; }
    public function setDescricao($descricao) { $this->descricao = $descricao; return $this; }
    public function setValorServico($valorServico) { $this->valorServico = $valorServico; return $this; }
    public function setTempoEstimado($tempoEstimado) { $this->tempoEstimado = $tempoEstimado; return $this; }
    public function setStatusServico($statusServico) { $this->statusServico = $statusServico; return $this; }
}

