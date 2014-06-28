<?php
session_start();
include("conecta.php");
        //echo "*** POST ***";
        //print_r($_POST);
        //echo "***FILES***";
        //print_r($_FILES);
        
        //echo "dataaaaa".$_POST['nombre_archivo'];
        $binario_titulo=$_FILES['foto']['name'];

        $binario_peso=$_FILES['foto']['size'];
        $binario_tipo=$_FILES['foto']['type'];
        
        $nombre=$_POST['nombre'];
        $usuari = $_SESSION['nombreusuari'];
        $URL=$_POST['URL'];
        $descripcion=$_POST['descripcion'];
        
        $selectedradio = $_POST['selectedradio'];
        //$tema=$_POST['tema'];
        $tag=$_POST['tag'];
        $tagnuevo = array();
        $tagnuevo[0]=$_POST['tagnuevo1'];
        $tagnuevo[1]=$_POST['tagnuevo2'];
        $tagnuevo[2]=$_POST['tagnuevo3'];

        $longitud=$_POST['longitud'];
        $latitud=$_POST['latitud'];
        //echo $longitud."long"."</br>";
        //echo $latitud."lat"."</br>";
    
        //if(!empty($_POST['nombre_archivo'])){
            //echo "insert";
    if( $longitud==NULL || $latitud==NULL){             //$binario_titulo==NULL ||
        
        echo "No se pudo finalizar el proceso, falta posicionar un marcador en el mapa...";
        
        }else{
           
           ///////////////////////////////////////////////////////////////////////////// 
           $uploaddir = 'uploadsAgentes/';
           $tmp_name = $_FILES['foto']['tmp_name'];
           $nombre_fichero_sin_espacios=str_replace(" ","",$_FILES['foto']['name']);
           
           $ruta = $uploaddir . $nombre_fichero_sin_espacios;
           
           move_uploaded_file($tmp_name,$ruta);
           
           //echo "tipo   ".$binario_tipo;
           
           switch ($binario_tipo) {
                case "image/jpeg":
                    $fuente = @imagecreatefromjpeg($ruta);
                    $imgAncho = imagesx ($fuente);
                    $imgAlto =imagesy($fuente);
                    
                    $thumbWidth = 100;
                    $new_width = $thumbWidth;
                    $new_height = floor( $imgAlto * ( $thumbWidth / $imgAncho ) );
                    
                    $imagen = imagecreatetruecolor( $new_width, $new_height );
                    //$imagen = ImageCreate($ancho,$alto); 
                    
                      ImageCopyResized($imagen,$fuente,0,0,0,0,$new_width,$new_height,$imgAncho,$imgAlto);
                      
                        //Header("Content-type: image/jpeg");
                        imageJpeg($imagen,"miniaturasAgentes/".$nombre_fichero_sin_espacios);
                    break;
                case "image/png":
                    $fuente = @imagecreatefrompng($ruta); //////
                    $imgAncho = imagesx ($fuente);
                    $imgAlto =imagesy($fuente);
                    
                    $thumbWidth = 100;
                    $new_width = $thumbWidth;
                    $new_height = floor( $imgAlto * ( $thumbWidth / $imgAncho ) );
                    
                    $imagen = imagecreatetruecolor( $new_width, $new_height ); ////////////
                    //$imagen = ImageCreate($ancho,$alto); 
                    
                      ImageCopyResized($imagen,$fuente,0,0,0,0,$new_width,$new_height,$imgAncho,$imgAlto);
                      
                        //Header("Content-type: image/png");
                        imagePng($imagen,"miniaturasAgentes/".$nombre_fichero_sin_espacios);   ///////////////
                    break;
                case "image/gif":
                    $fuente = @imagecreatefromgif($ruta); //////
                    $imgAncho = imagesx ($fuente);
                    $imgAlto =imagesy($fuente);
                    
                    $thumbWidth = 100;
                    $new_width = $thumbWidth;
                    $new_height = floor( $imgAlto * ( $thumbWidth / $imgAncho ) );
                    
                    $imagen = imagecreatetruecolor( $new_width, $new_height ); ////////////
                    //$imagen = ImageCreate($ancho,$alto); 
                    
                      ImageCopyResized($imagen,$fuente,0,0,0,0,$new_width,$new_height,$imgAncho,$imgAlto);
                      
                        //Header("Content-type: image/jpeg");
                        imageGif($imagen,"miniaturasAgentes/".$nombre_fichero_sin_espacios);   ///////////////
                    break;
            }
           
           
           
         ////////////////////////////////////////////////////////////////////////////////       
        
        for($i=0; $i<count($tagnuevo);$i++){
        if(!empty($tagnuevo[$i])){
            $checktag = mysql_query("SELECT tagAgente_nombre FROM tagAgente WHERE tagAgente_nombre='$tagnuevo[$i]'");
            $tagnuevo_exist = mysql_num_rows($checktag);
          
            if ($tagnuevo_exist>0) {
                    echo "El tag: $tagnuevo[$i] está en uso";
                
            }    
            else {
            $consulta_insertar= "INSERT INTO tagAgente (tagAgente_nombre) VALUE ('$tagnuevo[$i]')";
            mysql_query($consulta_insertar,$conexion) or die("No se pudo insertar los datos en la base de datos.");
                    echo "Tag: $tagnuevo[$i] introducido";
                    array_push($tag, $tagnuevo[$i]);	
            }
            
            
            }
            }
        
            $tagsSeleccionados = count($tag);
            echo $tagsSeleccionados."tagsSeleccionados";
            if($tagsSeleccionados > 1){
                $cadenaTags = implode(',',$tag);
                //echo $cadenaTags."cadenaTags";
                //echo $cadenaTags."tags"."</br>";
            
                $consulta_insertarConTags = "INSERT INTO agente (titulo_foto, peso_foto, tipo_foto, descripcion, nombre, longitud, latitud, url, selectedradio, tag, usuari) VALUES 
                ('$binario_titulo', '$binario_peso', '$binario_tipo','$descripcion','$nombre', '$longitud','$latitud','$URL', '$selectedradio', '$cadenaTags', '$usuari')";
                mysql_query($consulta_insertarConTags,$conexion) or die("que no que no tags.");
                

                }else{
                    $consulta_insertar = "INSERT INTO agente (titulo_foto, peso_foto, tipo_foto, descripcion, nombre, longitud, latitud, url, selectedradio, tag, usuari) VALUES 
                    ('$binario_titulo', '$binario_peso', '$binario_tipo','$descripcion','$nombre', '$longitud','$latitud','$URL', '$selectedradio', '$tag[0]', '$usuari')";
                mysql_query($consulta_insertar,$conexion) or die("que no que no.");
                }
                
                }
            
            
//                                $querymaterial_id= "SELECT material_id FROM documento WHERE titulo_registro='$nombre'";
//                                $resultmaterial_id= mysql_query($querymaterial_id,$conexion) or die("que no que no.");
//                                while ($resultado = mysql_fetch_assoc($resultmaterial_id)) {
//                                                    $material_id = $resultado['material_id'];
//                                                    echo $material_id."iddd"."</br>";
//                                }
                                
//                                $selRutaId="SELECT ruta_id FROM ruta WHERE (usuari_nombre= '$usuario') ORDER BY fechaRuta DESC LIMIT 1";
//                                $resultRutaId = mysql_query($selRutaId,$conexion) or die("que no que no ruta_id.");
//                                    while ($resultado = mysql_fetch_assoc($resultRutaId)) {
//                                            $rutaId = $resultado['ruta_id'];
//                                            echo $rutaId."RutaId"."</br>";
//                                    }
                                
//                                $rutaDoc="INSERT INTO rutaDoc (ruta_id, material_id) VALUES ('$rutaId','$material_id')";
//                                mysql_query($rutaDoc,$conexion) or die("que no que no rutaDoc.");
        //}
    //}
    
    /////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////
?>