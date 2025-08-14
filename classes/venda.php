<?php 

class venda{

    private float $valor;
    private clientes $cliente;
    private datetime $data_venda;
    
    public function __construct(float $valor, clientes $cliente)
    {
        $this->valor = $valor;
        $this->cliente = $cliente;
        $this->data_venda = new DateTime();
    }

    function getvalor(){
        return $this->valor;
    }

    function getcliente(){
        return $this->cliente;
    }

    function getdata_venda(){
        return $this->data_venda;
    }




}