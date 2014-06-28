<?php
header("Cache-Control: no-cache, must-revalidate");
session_start();
include("conecta.php");

$q=$_GET["q"];
//echo "q=  ".$q."</br>";
$chkinfo=$_GET["tag"] or exit("No Info Selected");
//echo "info=  ".$chkinfo."</br>";


if (isset($_GET['q'])){
    
    for($i=0; $i<count($chkinfo); $i++){ 
        echo "Tag: ".$chkinfo[$i]."</br>";
        //$tagsSelecconados = array();
        $consulta_tag = "SELECT * FROM documento WHERE tag LIKE '$chkinfo[$i]' ";
        $result4 = mysql_query($consulta_tag,$conexion);
        
        $markers = array();
                
        while ($registro4= mysql_fetch_object($result4) ){
            $markers[]=$registro4;
            
            $titulo = ($registro4->titulo_registro);
            $descripción = $registro4->descripcion;
            $tema = $registro4-> tema;
            $selectedradio = $registro4-> selectedradio;
            $tag = $registro4-> tag;
            $nombre = $registro4-> nombre_archivo;
            $id_doc = $registro4-> material_id;
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
    }
    
    $markersJson=json_encode($markers);
       ?>
       <script language="JavaScript" type="text/javascript">
                            var markersdata=eval(<?php echo $markersJson; ?>);
                            console.log("posicionandoPorTag");
                            verTodo();
                        </script>
       <?php
} 

?>