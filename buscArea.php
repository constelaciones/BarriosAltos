<?php
session_start();
include("conecta.php");
//$q=$_GET["q"];
// $francisco ='showhide';
//    $vieja = 'showhide';
//    $zabala = 'showhide';
    
if (isset($_GET["q"])){
    $tema = $_GET["q"];
    if($tema != ""){
    echo "Área: ".$tema."</br>";
    
    switch ($tema){
        //$francisco = 'showCheck';
        //print "print() francisco!.";
        case "Urbanismo":
        $queryBuscar2 = "SELECT * FROM documento WHERE tema LIKE 'Urbanismo'";
        break;
 
        case "Arquitectura":
        //$vieja = 'showCheck';
        //print "print() vieja!.";
        $queryBuscar2 = "SELECT * FROM documento WHERE tema LIKE 'Arquitectura'";
        break;

        case "Espacios":
        //$zabala= 'showCheck';
        //print "print() zabala!.";
        $queryBuscar2 = "SELECT * FROM documento WHERE tema LIKE 'Espacios'";
        break;
        
         case "Lugares":
        $queryBuscar2 = "SELECT * FROM documento WHERE tema LIKE 'Lugares'";
        break;
        
        case "Intervención pública":
        $queryBuscar2 = "SELECT * FROM documento WHERE tema LIKE 'Intervención pública'";
        break;
           }
       
       $result2 = mysql_query($queryBuscar2,$conexion);
       
       if (!$result2) {
            $error=mysql_error($conexion);
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryBuscar2")."<br>";
        }
    
    $markers = array();
    
       while ($registro2= mysql_fetch_object($result2) ){
           $markers[]=$registro2;
           
       $titulo = $registro2->titulo_registro;
       $descripción = $registro2->descripcion;
       $tema = $registro2-> tema;
       $selectedradio = $registro2-> selectedradio;
       $tag = $registro2-> tag;
       $nombre = $registro2-> nombre_archivo;
       $id_doc = $registro2-> material_id;
       ?>
        <div id="description<?php echo $id_doc; ?>"></div>
            <br>
        <div id="description" onclick="showDoc(<?php echo $id_doc; ?>)"><?php
           echo "Título: ".$titulo."</br>";
           echo "Descripción: ".$descripción."</br>";
           echo "Tema: ".$tema."</br>";
           echo "Tipo de archivo: ".$selectedradio."</br>";
           echo "Tag: ".$tag."</br>";
           echo "Nombre: ".$nombre; ?>
        </div><?php
 
       }
       
       $markersJson=json_encode($markers);
       ?>
       <script language="JavaScript" type="text/javascript">
                            var markersdata=eval(<?php echo $markersJson; ?>);
                            console.log("posicionandoPorArea");
                            verTodo();
                        </script>
       <?php  
    }
    }
?>