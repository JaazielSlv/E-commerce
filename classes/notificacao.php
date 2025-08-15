<?php 


abstract class Notification
{
    public function success($msg, $arquivo, $metodo){
        echo "<link rel='stylesheet' href='lib/aurora.css' >";
        $mensagem = " 
               <div class='aviso'>
                    <div class='msg bg-branco'>
                        <h2 class='fonte12 poppins-black fnc-sucesso'> {$msg} </h2>
                        <a href='index.php?arquivo={$arquivo}&metodo={$metodo}' class='btn-msg fnc-cinza-claro'>Fechar </a>
                    </div>
               </div>        
        ";

        echo $mensagem;
    }

    public function error($msg, $arquivo, $metodo){
        echo "<link rel='stylesheet' href='lib/aurora.css' >";
        $mensagem = " 
               <div class='aviso'>
                    <div class='msg bg-branco'>
                        <h2 class='fonte12 poppins-black fnc-error'> {$msg} </h2>
                        <a href='index.php?arquivo={$arquivo}&metodo={$metodo}' class='btn-msg fnc-cinza-claro'>Fechar </a>
                    </div>
               </div>        
        ";

        echo $mensagem;
    }
}