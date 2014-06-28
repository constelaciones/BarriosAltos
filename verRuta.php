<?php
session_start();
include("conecta.php");
//echo $_POST['valorNombreRuta'];
                            if(isset($_POST['valorNombreRuta'])){
                          
                                $busqueda = $_POST['valorNombreRuta'];
                                
                                    $selIdDocRuta= "SELECT ruta.nombre_ruta, rutaDoc.material_id FROM ruta INNER JOIN rutaDoc ON rutaDoc.ruta_id = ruta.ruta_id WHERE ruta.nombre_ruta = '$busqueda' ORDER BY rutaDoc.fecha_ruta ASC";
                                    $datos = mysql_query($selIdDocRuta, $conexion) or die ("No se pudo encontrar id_doc de la ruta");
                                    
                                    $docs_ids = array();
                                    $longitudesRuta = array();
                                    $latitudesRuta = array();
                                    $selectedradiosRuta = array();
                                         while ($resultado = mysql_fetch_assoc($datos)) {
                                                    $doc_id = $resultado['material_id'];
                                                    
                                                    array_push($docs_ids, $doc_id);
                                                    }
                                                    $totalDocsIds= count($docs_ids);
                                                        for($i=0; $i<$totalDocsIds;$i++){
                                                            
                                                            
                                    $selDatos="SELECT longitud, latitud, selectedradio FROM documento WHERE material_id = '$docs_ids[$i]' ";
                                    $datosSel = mysql_query($selDatos, $conexion) or die ("No se pudo ejecutar la consulta");
                                                while ($resultado = mysql_fetch_assoc($datosSel)) {
                                                                $longitudRuta = $resultado['longitud'];
                                                                //echo $longitudi."<br>";
                                                                $latitudRuta = $resultado['latitud'];
                                                                //echo$latitudi."<br>";
                                                                $selectedradioRuta = $resultado['selectedradio'];
                                                                //echo $selectedradioi;
                                                                
                                                                array_push($longitudesRuta, $longitudRuta);
                                                                array_push($latitudesRuta, $latitudRuta);
                                                                array_push($selectedradiosRuta, $selectedradioRuta);
                                                }
                                         }
                       
                                    $docs_idsJsonRuta = json_encode($docs_ids);
                                    $longitudesJsonRuta = json_encode($longitudesRuta);
                                    $latitudesJsonRuta = json_encode($latitudesRuta);
                                    $selectedradiosJsonRuta = json_encode($selectedradiosRuta);?>
                                    
                                    <script language="JavaScript" type="text/javascript">
                                    console.log("wiwi");
                                    var longitudesJsRuta = eval(<?php echo $longitudesJsonRuta; ?>);
                                    var latitudesJsRuta= eval(<?php echo $latitudesJsonRuta; ?>);
                                    var selectedradiosJsRuta= eval(<?php echo $selectedradiosJsonRuta; ?>);
                                    var material_idJsRuta = eval(<?php echo $docs_idsJsonRuta; ?>);
                                    verRuta();
                                    </script>
<?php }
?>