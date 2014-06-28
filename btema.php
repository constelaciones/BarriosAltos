<?php
session_start();
include("conecta.php");

    $radiobutons=array(
    "foto",
    "video",
    "texto",
    "audio",
    "clip");

      
      if (isset($_GET["selectedRadio"])){
      $selectedradio = $_GET["selectedRadio"];
        switch($selectedradio){
            case 0 :
            $Tipo = $radiobutons[0];
            break;

            case 1 :
            $Tipo = $radiobutons[1];
            break;

            case 2 :
            $Tipo = $radiobutons[2];
            break;
            
            case 3 :
            $Tipo = $radiobutons[3];
            break;
            
            case 4 :
            $Tipo = $radiobutons[4];
            break;

            }

             echo "Tipo seleccionado: ".$Tipo."</br>";
            $queryBuscar3 = "SELECT * FROM documento WHERE selectedradio LIKE '$Tipo'";
       
       $result3 = mysql_query($queryBuscar3,$conexion);
       if (!$result3) {
            $error=mysql_error($conexion);
   
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryBuscar3")."<br>";
        }
        
    
       while ($registro3= mysql_fetch_object($result3) ){
       $titulo = $registro3->titulo_registro;
       $descripcion = $registro3->descripcion;
       $tema = $registro3-> tema;
       $selectedradio = $registro3-> selectedradio;
       $tag = $registro3-> tag;
       $nombre = $registro3-> nombre_archivo;
       ?>
       
       <div id="description<?php echo $id_doc; ?>"></div>
        <br>
        <div id="description" onclick="showDoc(<?php echo $id_doc; ?>)"><?php
           echo "titulo: ".$titulo."</br>";
           echo "descripcion: ".$descripcion."</br>";
           echo "tema: ".$tema."</br>";
           echo "selectedradio: ".$selectedradio."</br>";
           echo "tag: ".$tag."</br>";
           echo "nombre: ".$nombre."</br>"."</br>";?>
        </div>
        
       }