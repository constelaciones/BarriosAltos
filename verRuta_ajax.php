<?php
mysql_query("SET NAMES 'utf8'", $conexion);
?>
<?php
    
    if(isset($_POST['nombre_ruta'])){
        
        $busqueda = $_POST['nombre_ruta'];
        
            $selIdDocRuta= "SELECT ruta.nombre_ruta, rutaDoc.material_id FROM ruta INNER JOIN rutaDoc ON rutaDoc.ruta_id = ruta.ruta_id WHERE ruta.nombre_ruta = '$busqueda' ORDER BY rutaDoc.fecha_ruta ASC";
            $datos = mysql_query($selIdDocRuta, $conexion) or die ("No se pudo encontrar id_doc de la ruta");
            
            $docs_ids = array();
            $longitudes = array();
            $latitudes = array();
            $selectedradios = array();
                 while ($resultado = mysql_fetch_assoc($datos)) {
                            $doc_id = $resultado['material_id'];
                            
                            array_push($docs_ids, $doc_id);
                            }
                            $totalDocsIds= count($docs_ids);
                                for($i=0; $i<$totalDocsIds;$i++){
                                    
                                    
            $selDatos="SELECT longitud, latitud, selectedradio FROM documento WHERE material_id = '$docs_ids[$i]' ";
            $datosSel = mysql_query($selDatos, $conexion) or die ("No se pudo ejecutar la consulta");
                        while ($resultado = mysql_fetch_assoc($datosSel)) {
                                        $longitud = $resultado['longitud'];
                                        
                                        $latitud = $resultado['latitud'];
                                        
                                        $selectedradio = $resultado['selectedradio'];
                                        
                                        
                                        array_push($longitudes, $longitud);
                                        array_push($latitudes, $latitud);
                                        array_push($selectedradios, $selectedradio);
    }
    }
            for($i=0; $i< count($longitudes);$i++){
                }
                }
                $longitudesJson = json_encode($longitudes);
                $latitudesJson = json_encode($latitudes);
                $selectedradiosJson = json_encode($selectedradios);
                
        ?>{
        "longitudes": <?php echo $longitudesJson; ?>,
        "latitudes": <?php echo $latitudesJson; ?>,
        "selectedradios": <?php echo $selectedradiosJson; ?>
    }