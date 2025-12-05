<?php

class Veiculo {
    private $id;
    private $idCliente;
    private $placa;
    private $marca;
    private $modelo;
    private $ano;
    private $cor;
    private $chassi;
    private $dataCadastro;

    public function __construct($idCliente, $placa, $marca, $modelo, $ano, $cor = null, $chassi = null, $dataCadastro = null, $id = null) {
        $this->id = $id;
        $this->idCliente = $idCliente;
        $this->placa = $placa;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->cor = $cor;
        $this->chassi = $chassi;
        $this->dataCadastro = $dataCadastro;
    }

    public function getId() { return $this->id; }
    public function getIdCliente() { return $this->idCliente; }
    public function getPlaca() { return $this->placa; }
    public function getMarca() { return $this->marca; }
    public function getModelo() { return $this->modelo; }
    public function getAno() { return $this->ano; }
    public function getCor() { return $this->cor; }
    public function getChassi() { return $this->chassi; }
    public function getDataCadastro() { return $this->dataCadastro; }

    public function setId($id) { $this->id = $id; return $this; }
    public function setIdCliente($idCliente) { $this->idCliente = $idCliente; return $this; }
    public function setPlaca($placa) { $this->placa = $placa; return $this; }
    public function setMarca($marca) { $this->marca = $marca; return $this; }
    public function setModelo($modelo) { $this->modelo = $modelo; return $this; }
    public function setAno($ano) { $this->ano = $ano; return $this; }
    public function setCor($cor) { $this->cor = $cor; return $this; }
    public function setChassi($chassi) { $this->chassi = $chassi; return $this; }
}

