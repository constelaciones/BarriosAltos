<?php
session_start();
include("conecta.php");

if (isset($_GET["q"])){
    $usuari=$_GET["q"];
    echo "Usuarix seleccionado: ".$usuari."</br>";

        $queryUsuario = "SELECT * FROM ruta WHERE usuari_nombre LIKE '$usuari'";
        //$queryUsuario = "SELECT ruta.*, rutaDoc.material_id FROM ruta INNER JOIN rutaDoc ON ruta.ruta_id = rutaDoc.ruta_id WHERE ruta.usuari_nombre LIKE '$usuari'";

        $result = mysql_query($queryUsuario,$conexion);
       if (!$result) {
            $error=mysql_error($conexion);
   
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryUsuario")."<br>";
        }
        
        $markers = array();
        $material_id = array();
        $materialesRuta = array();
        $matLongRuta = array();
        $matLatRuta = array();
        $matSelRadioRuta = array();
        
       while ($registro= mysql_fetch_object($result) ){
           $markers[]=$registro;
           
           $usuari = $registro-> usuari_nombre;
           $titulo = $registro->nombre_ruta;
           $descripcion = $registro->descripcion;
           $fecha = $registro-> fechaRuta;
           $id_ruta = $registro-> ruta_id;
           //$material_id = $registro -> material_id;
           
            
            $queryMaterial="SELECT material_id FROM rutaDoc where ruta_id = '$id_ruta'";
            $resultMaterial = mysql_query($queryMaterial,$conexion);
            
            if (!$resultMaterial) {
            $error=mysql_error($conexion);
   
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryMaterial")."<br>";

        }
        
        while($materialResp= mysql_fetch_object($resultMaterial) ){
           $material_id[]=$materialResp;
           
           $mat = $materialResp -> material_id;
           array_push($materialesRuta, $mat);
           
           $queryGeoMat="SELECT longitud, latitud, selectedradio FROM documento WHERE material_id = '$mat'";
           $resultGeoMat = mysql_query($queryGeoMat,$conexion);
            
            if (!$resultGeoMat) {
            $error=mysql_error($conexion);
   
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryGeoMat")."<br>";
           
           }
           
           while($materialGeoResp= mysql_fetch_object($resultGeoMat) ){
            $matGeo [] = $materialGeoResp;
            
            $matLong = $materialGeoResp -> longitud;
            $matLat = $materialGeoResp -> latitud;
            $matSelRadio = $materialGeoResp -> selectedradio;
            
            array_push($matLongRuta, $matLong);
            array_push($matLatRuta, $matLat);
            array_push($matSelRadioRuta, $matSelRadio);
                  
            }
            }
            
           $TotalmaterialesRuta = count($materialesRuta);
           ?>
           
           <div id="description"><?php
            echo "Título: ".$titulo."</br>";
            echo "Descripción: ".$descripcion."</br>";
            echo "Fecha: ".$fecha."</br>"; 
                //for($i=0; $i<= $TotalmaterialesRuta - 1 ; $i++){
                  //  echo "material".$materialesRuta[$i].$i."</br>"; 
                  //  echo "matLong".$matLongRuta[$i]."</br>";
                    //echo "matLat".$matLatRuta[$i]."</br>";
                    //echo "matSelRadio".$matSelRadioRuta[$i]."</br>";
                //}?>
            </div>
            <br><?php
            
            //$markersTodo = json_encode($matGeo);
            $markers_idJson=json_encode($material_id);
            $markers_JsonLong=json_encode($matLongRuta);
            $markers_JsonLat=json_encode($matLatRuta);
            $markers_JsonSelRadio=json_encode($matSelRadioRuta);
            ?>
                        <script language="JavaScript" type="text/javascript">
                            //var markersTodo = eval(<?php echo $markersTodo; ?>);
                            var markersdataId=eval(<?php echo $markers_idJson; ?>);
                            var markersdataLong=eval(<?php echo $markers_JsonLong; ?>);
                            var markersdataLat=eval(<?php echo $markers_JsonLat; ?>);
                            var markersdataSelRadio=eval(<?php echo $markers_JsonSelRadio; ?>);
                            console.log("posicionandoRutaPorUsuario");
                            verRutaUsuario();
                        </script>
        <?php
            
        $materialesRuta = array();
        $matLongRuta = array();
        $matLatRuta = array();
        $matSelRadioRuta = array();
       

    }
    }
?>