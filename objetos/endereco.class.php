<?php
class Endereco{
    public $logadouro;
    public $complemento;
    public $bairro;
    public $cidade;
    public $estado;
    public $pais;
    public $cep;

    public function __construct($logadouro,$complemento,$bairro,$cidade,$estado,$pais,$cep){
        $this->logadouro = $logadouro;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->pais = $pais;
        $this->cep = $cep;

    }


}

?>
