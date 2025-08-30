<?php 

if($_GET):

    $controller = $_GET['arquivo'];
    $metodo = $_GET['metodo'];

    require_once"classes/".$controller.".php";

    $obj = new $controller();
    $obj->$metodo();

else:
    require_once "classes/controlador.php";
    $obj = new Controlador();
    $obj->index();
    


endif;



?>