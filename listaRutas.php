<?php
session_start();
include("conecta.php");
    echo "LLegó";
    //$listado = array();
    $queryBuscarRuta = "SELECT * FROM ruta";
    $resultRuta = mysql_query($queryBuscarRuta,$conexion);
                                                                                        
        if (!$resultRuta) {
        $error=mysql_error($conexion);
        die ("Se ha producido un error al ejecutar la búsqueda.<br>MySQL dice: $error<br>La query era: $queryBuscarRuta")."<br>";
        }
                                                                                        
        while ($registro= mysql_fetch_object($resultRuta)) {
        $titulo = $registro -> nombre_ruta;
        $usuari = $registro -> usuari_nombre;
        $fechaRuta = $registro -> fechaRuta;
        $descripcion = $registro -> descripcion;
        $ruta_id = $registro -> ruta_id;
        //array_push($listado, $titulo);
        ?>
            <div id="description"><?php
               echo "Título: ".$titulo."</br>";
               echo "Fecha: ".$fechaRuta."</br>";
               echo "Usuarix: ".$usuari."</br>"; 
               echo "Descripción: ".$descripcion."</br>"; ?>
            </div>
            <br><?php
        }

?>