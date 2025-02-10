<?php


include("conexion.php");


//Datos del horario 

$hora_incio=8;
$hora_fin=9;

$dias_agenda=7;


//Intervalo de minutos entre los que hay cita 

$min_cita=5;


$hoy = date("d-m-Y");

//Array donde se guardan las consultas de citas
$citas_ocupadas= array();
$citas_usuario=array();


//Inciciamos y comprobamos sesión; 
session_start();


if (isset($_SESSION["usuario"])){

    if($_SESSION["usuario"] != ""){

    //Si hay usuario en la sesión hacemos la consulta de sus citas y rellenamos el array de las citas del usuario   
        
    $usuario = $_SESSION["usuario"];


    $sql_usuario = "SELECT  fecha_cita, hora_cita FROM citas WHERE num_usu='$usuario'";

    $citas= $conexion->query($sql_usuario);

        foreach ($citas as $cita){

            $fecha= $cita["fecha_cita"];
            $hora= $cita["hora_cita"];

            $fecha_formateada = date("d-m-Y", strtotime($fecha));

            array_push($citas_usuario, array($fecha_formateada, $hora));

        }
    }

}


// Consultamos todas las citas que hay y rellenamos el array 

$sql_citas = "SELECT fecha_cita, hora_cita FROM citas ";


$citas= $conexion->query($sql_citas);

foreach ($citas as $cita){

    $fecha= $cita["fecha_cita"];
    $hora= $cita["hora_cita"];

    $fecha_formateada = date("d-m-Y", strtotime($fecha));

    array_push($citas_ocupadas, array($fecha_formateada, $hora));

}



?>
            <h2 class="text text-center">Citas</h2>


            <div class="d-flex flex-wrap justify-content-center">
            <?php


                 //Hacemos que la posibilidad de citas comience mañana 
                $dia =date("d-m-Y", strtotime($hoy."+ 1 days"));


                //Recorremos los días de los que vamos a ofrecer las citas

                for($dia; strtotime($dia)<= strtotime($hoy."+ $dias_agenda days"); $dia = date("d-m-Y", strtotime($dia."+ 1 days"))){


                        echo "<table class='table table-hover table-sm me-3 mb-3 text-center' style='width:7vw'>
                                <thead> 
                                    <th> $dia</th> 
                                </thead>
                                
                                <tbody>";    
                                
                                
                        //Recorremos las horas que están dentro del intervalo del horario
                
                        for($hora=$hora_incio; $hora<$hora_fin; $hora++ ){
                            if($hora <10){
                                $hora = "0$hora"; //Formato para horas de un dígito. 
                            }


                            //Recorremos los minutos de cada hora segun la duracion de la cita

                            for ($minutos = 0; $minutos < 60; $minutos += $min_cita) {

                                if($minutos<10){

                                    $minutos= "0$minutos"; //Formato para minutos de un dígito. 
                                }

                                $horario = "$hora:$minutos"; //Horario compuesto por hora y minutos

                                $horario_array= "$hora:$minutos:00"; //Formato para que coincida con el formato de los arrays

                             
                              
                              //Comprobamos qué citas están ocupadas, de ellas cuales son del usuario actual y establecemos clase de bootstrap diferente en cada caso 

                                if(in_array(array($dia,$horario_array),$citas_ocupadas)){
                                    $color ="text-danger";
									$onclick="#";
                                    $ayuda= "Cita no disponible";
                                    $cursor="none";

                                    if(in_array(array($dia,$horario_array),$citas_usuario)){
                                        $color= "text-primary";
										$onclick= "mostrar_cita(`$dia`,`$horario`)";
                                        $ayuda= "Cita reservada: haz click para verla";
                                        $cursor="pointer";
										

                                    }

                                
                                }else{

                                    $color="text-success";
									$onclick="citar(`$dia`,`$horario`)";
                                    $ayuda= "Cita disponible: haz click para reservar";
                                    $cursor="pointer";
                                   
                                }


                                echo "<tr><td>$horario <abbr title='$ayuda'><i onclick='$onclick' class='bi bi-droplet-fill $color ms-2' style='cursor:$cursor'></i></abbr></td></tr>";
                                

                            }
                        }

                        echo "  </table>";
                }

                ?>
            </div>
        