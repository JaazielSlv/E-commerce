<?php 

class paypal extends notificacao implements pagamento_interface
{
    public function pagar($valor)
    {
        echo"pagou paypal o valor de; ". $valor;
    }
}