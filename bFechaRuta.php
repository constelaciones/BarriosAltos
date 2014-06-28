<?php
session_start();
include("conecta.php");
    
if (isset($_GET["fecha"])){
    $fecha = $_GET["fecha"];
    echo "Fecha: ".$fecha."</br>";
    
     $queryFecha = "SELECT * FROM ruta WHERE fechaRuta LIKE '$fecha%'";
     $result = mysql_query($queryFecha,$conexion);
       
       if (!$result) {
            $error=mysql_error($conexion);
            echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $queryFecha")."<br>";
        }
    
    $markers = array();
    $material_id = array();
    $materialesRuta = array();
    $matLongRuta = array();
    $matLatRuta = array();
    $matSelRadioRuta = array();
    
       while ($registro= mysql_fetch_object($result) ){
           $markers[]=$registro;
           
       $titulo = $registro->nombre_ruta;
       $descripción = $registro->descripcion;
       $usuari = $registro-> usuari_nombre;
       $ruta_id = $registro-> ruta_id;
       $fecha = $registro-> fechaRuta;

       
      $queryMaterial="SELECT material_id FROM rutaDoc where ruta_id = '$ruta_id'";
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
           echo "Descripción: ".$descripción."</br>";
           echo "Usuario: ".$usuari; 
           echo "Fecha: ".$fecha."</br>"; ?>
        </div><?php
        
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
                            console.log("posicionandoRutaPorFecha");
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