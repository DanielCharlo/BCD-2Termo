<?php
class OS {
    private $id, $dataAbertura, $dataFechamento, $status, $idVeiculo;

    public function __construct($dataAbertura, $status, $idVeiculo, $dataFechamento=null, $id=null){
        $this->id = $id;
        $this->dataAbertura = $dataAbertura;
        $this->dataFechamento = $dataFechamento;
        $this->status = $status;
        $this->idVeiculo = $idVeiculo;
    }

    public function getId(){ return $this->id; }
    public function getDataAbertura(){ return $this->dataAbertura; }
    public function getDataFechamento(){ return $this->dataFechamento; }
    public function getStatus(){ return $this->status; }
    public function getIdVeiculo(){ return $this->idVeiculo; }
}
?>
