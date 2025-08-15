<?php 

require_once 'notificacao.php';
require_once 'pagamento_interface.php';

class boleto extends Notification implements pagamento_interface
{
    public function pagar($valor)
    {
        echo "Boleto gerado no valor de: R$ ". number_format($valor, 2, ',', '.');
    }
}