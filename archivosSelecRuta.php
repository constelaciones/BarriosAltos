<?php
header("Cache-Control: no-cache, must-revalidate");
session_start();
include("conecta.php");
$usuari = $_SESSION["nombreusuari"];

$q=$_GET["q"];
//echo "q=  ".$q."</br>";
$docs=$_GET["documento"] or exit("No Info Selected");
//echo "info=  ".$docs."</br>";


if (isset($_GET['q'])){
    
for($i=0; $i<count($docs); $i++){ 
    echo $docs[$i]."arraying"."</br>";
    
            $querymaterial_id= "SELECT material_id FROM documento WHERE titulo_registro='$docs[$i]'";
            $resultmaterial_id= mysql_query($querymaterial_id,$conexion) or die("que no que no.");
            while ($resultado = mysql_fetch_assoc($resultmaterial_id)) {
                                    $material_id = $resultado['material_id'];
                                    echo $material_id."iddd"."</br>";
             }
             
            $selRutaId="SELECT ruta_id FROM ruta WHERE (usuari_nombre= '$usuari') ORDER BY fechaRuta DESC LIMIT 1";
            $resultRutaId = mysql_query($selRutaId,$conexion) or die("que no que no selecciono rutaID.");
            while ($resultado = mysql_fetch_assoc($resultRutaId)) {
                                    $rutaId = $resultado['ruta_id'];
                                    echo $rutaId."RutaId"."</br>";
            }

            $rutaDoc="INSERT INTO rutaDoc (ruta_id, material_id) VALUES ('$rutaId','$material_id')";
                                    mysql_query($rutaDoc,$conexion) or die("que no que no inserto rutaDoc.");
                                    
                                    
            //$tagsSelecconados = array();
                    
                
                //$consulta_tag = "SELECT * FROM documento WHERE tag LIKE '$chkinfo[$i]' ";
                
       }   
} 


//foreach ($_POST['documento'] as $doc){  
//                        echo $doc."dooc"."<br>";
//            }


//$selHitosRuta="SELECT material_id FROM rutaDoc WHERE (ruta_id= '$rutaId') ORDER BY fecha_ruta ASC";
//                                    $resulHitosRuta = mysql_query($selHitosRuta,$conexion) or die("que no que no selecciono hitos ruta.");
//                                            $hitos = Array();
//                                            while ($resultado = mysql_fetch_assoc($resulHitosRuta)) {
//                                                        $hito = $resultado['material_id'];
//                                                        echo $hito;
//                                                        array_push($hitos, $hito);
//                                                        }
//                                                        $totalHitos = count($hitos);
//                                                        $longitudHitos = Array();
//                                                        $latitudHitos = Array();
//                                            for($i=0; $i<$totalHitos; $i++){
//                                                $selLongLat="SELECT longitud, latitud FROM documento WHERE (material_id= '$hitos[$i]')";
//                                                $resulselLongLat = mysql_query($selLongLat,$conexion) or die("que no que no selecciono long/lat hitos ruta.");
//                                                }
//                                                while ($resultado = mysql_fetch_assoc($resulselLongLat)) {
//                                                    $longitudesHitos= $resultado['longitud'];
//                                                    echo $longitudesHitos."LOOOOOOOONG"."</br>";
//                                                    array_push($longitudHitos, $longitudesHitos);
//                                                    $latitudesHitos= $resultado['latitud'];
//                                                    echo $latitudesHitos."LAAAAAAAT"."</br>";
//                                                    array_push($latitudHitos, $latitudesHitos);
//                                                    }
//                                                    //$hitosJson = json_encode($hitos);
//                                                    $longitudesJson = json_encode($longitudHitos);
//                                                    $latitudesJson = json_encode($latitudHitos);
?>
//                                                   
<!--<script language="JavaScript" type="text/javascript">
    //var hitosJs = eval( <?php echo $hitosJson; ?>);
    var latitudesJs= eval(<?php echo $latitudesJson; ?>);
    var latitudesJs= eval(<?php echo $latitudesJson; ?>);
    //var selectedradiosJs= eval(<?php echo $selectedradiosJson; ?>);
</script> -->
