<?php 

class clientes{

    private int $id;
    private string $nome;
    private string $cpf;

    function __construct(int $id, string $nome, string $cpf)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function getid(){
        return $this->id;
    }
        

    public function getnome(){
        return $this->nome;
    }
        

    public function getcpf(){
        return $this->cpf;
    }
        
    public function obter_cliente(){
        return $clientes = [
        new clientes(1, 'joao silva', '111.111.111-11'),
        new clientes(2, 'lucas jose', '222.222.222-22'),
        new clientes(3, 'pato santos', '333.333.333-33')

        ];
    }














}







