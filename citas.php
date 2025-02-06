<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citas";

$conexion = new mysqli($servername, $username, $password, $dbname);


$hora_incio=8;
$hora_fin=9;

$dias_agenda=7;


$hoy = date("d-m-Y");


$citas_ocupadas= array();


$sql_citas = "SELECT fecha_cita, hora_cita FROM citas ";


$citas= $conexion->query($sql_citas);

foreach ($citas as $cita){

    $fecha= $cita["fecha_cita"];
    $hora= $cita["hora_cita"];

    $fecha_formateada = date("d-m-Y", strtotime($fecha));

    array_push($citas_ocupadas, array($fecha_formateada, $hora));

   echo "$fecha_formateada $hora";
}



?>
 <h2 class="text text-center">Citas</h2>


 <div class="d-flex flex-wrap justify-content-center">
<?php

    $dia =date("d-m-Y", strtotime($hoy."+ 1 days"));

    for($dia; strtotime($dia)<= strtotime($hoy."+ $dias_agenda days"); $dia = date("d-m-Y", strtotime($dia."+ 1 days"))){


            echo "<table class='table table-hover table-sm me-3 mb-3 text-center' style='width: 200px;'>
                    <thead> 
                        <th> $dia</th> 
                    </thead>
                    
                    <tbody>";            
    
            for($hora=$hora_incio; $hora<$hora_fin; $hora++ ){
                if($hora <10){
                    $hora = "0$hora";
                }


                for ($minutos = 0; $minutos < 60; $minutos += 5) {

                    if($minutos<10){

                        $minutos= "0$minutos";
                    }

                    $horario = "$hora:$minutos";


                    echo "<tr><td>$horario<i class='bi bi-circle-fill ms-2'></i></i></td></tr>";

                    

                }
            }

            echo "  </table>";
    }

    ?>
</div>
        