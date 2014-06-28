<?php
session_start();
include("conecta.php");

if (isset($_GET["q"])){
    $usuari=$_GET["q"];
    echo "Usuarix seleccionado: ".$usuari."</br>";

        $queryUsuario = "SELECT * FROM documento WHERE usuari LIKE '$usuari'";

        $result = mysql_query($queryUsuario,$conexion);
       if (!$result) {
            $error=mysql_error($conexion);
   
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryUsuario")."<br>";
        }
        
        $markers = array();
        
       while ($registro= mysql_fetch_object($result) ){
           $markers[]=$registro;
           
           $titulo = $registro->titulo_registro;
           $descripcion = $registro->descripcion;
           $tema = $registro-> tema;
           $selectedradio = $registro-> selectedradio;
           $tag = $registro-> tag;
           $nombre = $registro-> nombre_archivo;
           $id_doc = $registro-> material_id;
           ?>
            <div id="description<?php echo $id_doc; ?>"></div>
            <br>
            <div id="description" onclick="showDoc(<?php echo $id_doc; ?>)"><?php
               echo "Título: ".$titulo."</br>";
               echo "Descripción: ".$descripcion."</br>";
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
                            console.log("posicionandoPorUsuario");
                            verTodo();
                        </script>
       <?php
    }  

?>