<?php

$accion = $_POST["accion"];
$dia =$_POST["dia"];
$hora= $_POST["hora"];

//formato fecha
$fecha= date("Y-m-d", strtotime($dia));

include("conexion.php");

session_start();



if($accion=="nueva"){     

    //insertamos la cita en el caso de que haya usuario en la sesión
    if (isset($_SESSION["usuario"])){
        
        $usuario = $_SESSION["usuario"];

        $sql= "INSERT INTO citas (fecha_cita, hora_cita, num_usu) VALUES ('$fecha', '$hora', '$usuario')";

        $conexion->query($sql);

        echo "registrada";

    } else{

        echo "no_usuario";
    }

} else if($accion == "cancelar"){

    //cancelamos la cita en el caso de que haya usuario en la sesión

    if (isset($_SESSION["usuario"])){
        
        $usuario = $_SESSION["usuario"];


        $sql= "DELETE FROM citas WHERE fecha_cita='$fecha' AND hora_cita='$hora' AND num_usu='$usuario'";

        $conexion->query($sql);

        echo "cancelada";
    }else{

        echo "no_usuario";

    }








}






?>