<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citas";

$conexion = new mysqli($servername, $username, $password, $dbname);


$hora_incio=8;
$hora_fin=10;


$hoy = date("d-m-Y");

$fechafinstring  = strtotime($hoy."+ 7 days");

$fecha_fin = date("d-m-Y", $fechafinstring);

?>
 <h2>Citas Disponibles</h2>
 <table class="table table-hover">
       
    <thead> 
 
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
        </tr>

    </thead>
    <tbody>

<?php

for($dia=$hoy; strtotime($dia)<= strtotime($fecha_fin); $i = date("d-m-Y", strtotime($dia."+ 1 days"))){

        for($hora=$hora_incio; $hora<$hora_fin; $hora++ ){
            if($hora <10){
                $hora = "0$hora";
            }
            for ($minuto = 0; $minuto < 60; $minuto += 5) {

                if($minuto<10){

                    $minuto= "0$minutos"
                }

            

                

            }
        }
}


?>

    


    </tbody>




</table>