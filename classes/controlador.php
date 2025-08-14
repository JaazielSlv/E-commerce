<?php 
session_start();
require_once"classes/produto.php";
class controlador{



    public function index()
    {
        $prod = new produto();
        $ret = $prod->gerar_produtos();
        require_once "public/home/home.php";
    }

    public function inserircarrinho()
    {
        $id = 0;
        if($_GET && isset($_GET['id'])):
            $id = $_GET['id'];

            $produto = (new produto())->obter_produto_por_id($id);


            $_SESSION['carrinho']['id'] = $produto->getid();
            $_SESSION['carrinho']['descricao'] = $produto->getdescricao();
            $_SESSION['carrinho']['preco'] = $produto->getpreco();
            $_SESSION['carrinho']['imagem'] = $produto->getimagem();
            $_SESSION['carrinho']['qtde'] = 5;

        endif;

        require_once"public/home/carrinho/index.php";
    }
}







?>