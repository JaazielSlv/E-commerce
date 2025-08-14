<?php 

class cartao_credito extends notificacao implements pagamento_interface
{
    public function pagar($valor)
    {
        echo"pagou no cartao o valor de; ". $valor;
    }
}