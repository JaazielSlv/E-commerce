<?php

abstract class notificacao
{
    public function sucesso($msg, $arquivo, $metodo)
    {
        echo "<link rel'stylesheet' href='leb/aurora.css'>";
        $mensagem = "
        <div class'aviso'>
            <div class='msg bg-branco'>
                <h2 class='fonte12 popping-black fnc-sucesso'>{$msg}</h2>
                <a href='index.php?arquivo={$arquivo}&metodo={$metodo}' class'btn-msg fnc-cinza-claro'>Fechar</a>
            </div>
        </div>
        ";
        return $mensagem;
    }

    public function erro($msg, $arquivo, $metodo)
    {
        echo "<link rel'stylesheet' href='leb/aurora.css'>";
        $mensagem = "
        <div class'aviso'>
            <div class='msg bg-branco'>
                <h2 class='fonte12 popping-black fnc-error'>{$msg}</h2>
                <a href='index.php?arquivo={$arquivo}&metodo={$metodo}' class'btn-msg fnc-cinza-claro'>Fechar</a>
            </div>
        </div>
        ";
        return $mensagem;
    }






}
