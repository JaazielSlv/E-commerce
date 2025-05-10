<?php 

class boleto extends notificacao implements pagamento_interface
{
    public function pagar($valor)
    {
        echo"boleto gerado no valoer de: ". $valor;
    }
}