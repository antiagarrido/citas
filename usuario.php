<?php
$accion=$_POST["accion"];

session_start();

if($accion=="comprobar"){

    $usuario="";

    if (isset($_SESSION["usuario"])){
        
        $usuario = $_SESSION["usuario"];
    }
        
        echo $usuario;
        

}else if($accion=="limpiar"){

    session_destroy();

}else if($accion=="asignar"){
        
        $n_asegurado=$_POST["asegurado"];

        $_SESSION["usuario"]=$n_asegurado;

        echo $n_asegurado;
}



?>