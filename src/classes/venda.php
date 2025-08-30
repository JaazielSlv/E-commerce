<?php 

class Venda
{
    private float $valor;
    private Clientes $cliente;
    private DateTime $dataVenda;

    public function __construct(float $valor, Clientes $cliente){
        $this->valor = $valor;
        $this->cliente = $cliente;
        $this->dataVenda = new DateTime();
    }

    public function getValor(){
        return $this->valor;
    }
    public function getCliente(){
        return $this->cliente;
    }
    public function getDataVenda(){
        return $this->dataVenda;
    }

}