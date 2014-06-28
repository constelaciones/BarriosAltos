<?php
session_start();
include("conecta.php");

        //echo "data Ruta".$_POST['nombre_archivo'];
        $binario_titulo=$_FILES['archivo']['name'];
        $binario_peso=$_FILES['archivo']['size'];
        $binario_tipo=$_FILES['archivo']['type'];
        
        $nombre=$_POST['nombre_archivo'];
        $usuari = $_SESSION['nombreusuari'];
        //$fecha_mat = $_POST['fecha_mat'];
        //$URL=$_POST['URL'];
        $descripcion=$_POST['descripcion'];
        
        $selectedradio = $_POST['selectedradio'];
        //$tema=$_POST['tema'];
        $tag=$_POST['tag'];
        $tagnuevo = array();
        $tagnuevo[0]=$_POST['tagnuevo1'];
        $tagnuevo[1]=$_POST['tagnuevo2'];
        $tagnuevo[2]=$_POST['tagnuevo3'];

        $longitud=$_POST['longitudRuta'];
        $latitud=$_POST['latitudRuta'];
        //echo $longitud."long"."</br>";
        //echo $latitud."lat"."</br>";
        
        $nodos_ids=  array();
    
        //if(!empty($_POST['nombre_archivo'])){
            //echo "insert";
            
        if( $longitud==NULL || $latitud==NULL){             //$binario_titulo==NULL ||
        
        echo "No se pudo finalizar el proceso, falta posicionar un marcador en el mapa...";
        
        
        }else{
            
           $CorrectaGeoposicion = true;
           }
           
    if( $binario_peso >= 25000000 ){
        
        echo "No se pudo finalizar el proceso, el documento ocupa demasiado espacio...";
           
           }else{
               
           $CorrectoPeso = true;
           }
           
    if( $nombre == NULL ){
        
        echo "No se pudo finalizar el proceso, el titulo del documento es imprescindible...";
           
           }else{
               
           $CorrectoTitulo = true;
           }
           
    if( $CorrectaGeoposicion && $CorrectoPeso && $CorrectoTitulo){
        
        
        for($i=0; $i<count($tagnuevo);$i++){
        if(!empty($tagnuevo[$i])){
            $checktag = mysql_query("SELECT nombre_tag FROM tag WHERE nombre_tag='$tagnuevo[$i]'");
            $tagnuevo_exist = mysql_num_rows($checktag);
          
            if ($tagnuevo_exist>0) {
                    echo "El tag: $tagnuevo[$i] está en uso";
                
            }    
            else {
            $consulta_insertar= "INSERT INTO tag (nombre_tag) VALUE ('$tagnuevo[$i]')";
            mysql_query($consulta_insertar,$conexion) or die("No se pudo insertar los datos en la base de datos.");
                    //echo "Tag: $tagnuevo[$i] introducido";
                    array_push($tag, $tagnuevo[$i]);	
            }
            
            
            }
            }
        
            $tagsSeleccionados = count($tag);
            //echo $tagsSeleccionados."tagsSeleccionados";
            if($tagsSeleccionados > 1){
                $cadenaTags = implode(',',$tag);
                //echo $cadenaTags."cadenaTags";
                //echo $cadenaTags."tags"."</br>";
            
                $consulta_insertarConTags = "INSERT INTO documento (titulo_registro, peso, extension, descripcion, nombre_archivo, longitud, latitud, selectedradio, tag, usuari) VALUES 
                ('$nombre', '$binario_peso', '$binario_tipo','$descripcion','$binario_titulo', '$longitud','$latitud', '$selectedradio', '$cadenaTags', '$usuari')";
                mysql_query($consulta_insertarConTags,$conexion) or die("que no que no tags.");
                

                }else{
                    $consulta_insertar = "INSERT INTO documento (titulo_registro, peso, extension, descripcion, nombre_archivo, longitud, latitud, selectedradio, tag, usuari) VALUES 
                    ('$nombre', '$binario_peso', '$binario_tipo','$descripcion','$binario_titulo', '$longitud','$latitud', '$selectedradio', '$tag[0]', '$usuari')";
                mysql_query($consulta_insertar,$conexion) or die("que no que no.");
                }
            
            
             //y ahora: insertar tambien en RutaDoc!!!
            
                                $querymaterial_id= "SELECT material_id FROM documento WHERE titulo_registro='$nombre'";
                                $resultmaterial_id= mysql_query($querymaterial_id,$conexion) or die("que no que no.");
                                while ($resultado = mysql_fetch_assoc($resultmaterial_id)) {
                                                    $material_id = $resultado['material_id'];
                                                    //echo $material_id."iddd"."</br>";
                                }
                                
                                $selRutaId="SELECT ruta_id, nombre_ruta FROM ruta WHERE (usuari_nombre= '$usuari') ORDER BY fechaRuta DESC LIMIT 1";
                                $resultRutaId = mysql_query($selRutaId,$conexion) or die("que no que no ruta_id.");
                                    while ($resultado = mysql_fetch_assoc($resultRutaId)) {
                                            $rutaId = $resultado['ruta_id'];
                                            $nombre_ruta = $resultado['nombre_ruta'];
                                            //echo $rutaId."RutaId"."</br>";
                                    }
                                
                                $rutaDoc="INSERT INTO rutaDoc (ruta_id, material_id) VALUES ('$rutaId','$material_id')";
                                mysql_query($rutaDoc,$conexion) or die("que no que no rutaDoc.");
             
                                
            //resumen documentos ruta
            $selResumen="SELECT material_id FROM rutaDoc WHERE (ruta_id= '$rutaId')";                    
               $resultSelResumen = mysql_query($selResumen,$conexion) or die("que no que no Selresumen");                 
                                while ($resultado = mysql_fetch_assoc($resultSelResumen)) {
                                    $nodoRuta_id = $resultado['material_id'];
                                    //echo $nodoRuta_id."</br>";
                                    array_push($nodos_ids, $nodoRuta_id);
                                    }
                     $totalDocsRuta = count($nodos_ids);
                     //echo $totalDocsRuta."</br>";
                     
                    echo "Resumen de la ruta:  ".$nombre_ruta."</br>";
                     for ($i=0;$i<=$totalDocsRuta-1;$i++) {       
             $Resumen="SELECT titulo_registro FROM documento WHERE (material_id= '$nodos_ids[$i]')"; 
                  $resultResumen = mysql_query($Resumen,$conexion) or die("que no que no resumen");
                                while ($resultado = mysql_fetch_assoc($resultResumen)) { 
                                    $docRuta = $resultado['titulo_registro'];
                                    echo   1+$i."  ".$docRuta."</br>";         
                                }
                                
                                
          }
          }
?>