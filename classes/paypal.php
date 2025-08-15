<?php 

require_once 'pagamento_interface.php';
require_once 'notificacao.php';

class PayPal extends Notification implements pagamento_interface
{
    public function pagar($valor){
        $msg =  "Pagamento no valor de R$ ".number_format($valor,2 ,',','.')." realizado via PayPal";
        echo $msg;
    }
}