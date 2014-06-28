<?php
session_start();
$conexion = mysql_connect('localhost','administradora','bilbo') or die("No se pudo realizar la conexion con el servidor.");
mysql_query("SET NAMES 'utf8'", $conexion);
mysql_select_db("bilboZaharra" ,$conexion) or die("No se puede seleccionar BD");
//require('json.php');
$usuario = $_SESSION["nombreusuari"];
echo $usuario."USU"."</br>";
$edicion = False;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/javascript" src="js/generar.js"></script>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script language="JavaScript" type="text/javascript" src="js/crearRuta2.js"></script>



<style type="text/css">
      #basicMap {
          width: 1024;
          height: 768;
          margin: 0;
      }
    </style>
    
    

<form name="info_ruta" id="info_ruta" enctype="multipart/form-data" method="post">
            <p>Nombre de la Ruta<input type="text" name="nombre_ruta" id="nombre_ruta"/></p>
            <p>Descripción<input type="text" name="descripción" id="descripción"/></p>
            <p><input type="submit" name="crear_ruta" id="crear_ruta" value="crear_ruta"/> </p>
            
            </form>
            
</head>
<body onload="init();">

<?php
if (isset($_POST['crear_ruta'])) {
    if(!empty($_REQUEST['nombre_ruta'])){
        $nombre_ruta = $_POST['nombre_ruta'];
        $descripcion = $_POST['descripción'];
        $usuari_nombre = $_SESSION["nombreusuari"];
        
        $revisarNombreRuta="SELECT nombre_ruta FROM ruta WHERE nombre_ruta='$nombre_ruta' ";
        $queryRevisar= mysql_query($revisarNombreRuta,$conexion);
        $revisarNombre = mysql_num_rows($queryRevisar);
        if($revisarNombre>0) {
            echo "Este nombre de ruta está ya en uso";
                                
                                }else{

    $insertarRuta="INSERT INTO ruta (nombre_ruta, descripcion, usuari_nombre) VALUES ('$nombre_ruta', '$descripcion', '$usuari_nombre')"; 
    mysql_query($insertarRuta,$conexion) or die("que no que no inserto ruta.");
    }
    
    }else{
    echo "falta introducir la información de la rutas!";
    }
    
    }
?>
<div id="basicMap"></div>

<form  name="archivo_existente" id="archivo_existente" method="post"/>
                                            
<?php
if(isset($usuario)){
    ?> <p> Seleccionar existente</p></br><?php


    $docsUsuario = "SELECT titulo_registro FROM documento WHERE usuari='$usuario' ORDER BY titulo_registro DESC" ;
    $resultDocs = mysql_query($docsUsuario,$conexion) or die("que no que no.");
    
    $documentos=  array();
                            while ($resultado = mysql_fetch_assoc($resultDocs)) {
                                $nombreDoc = $resultado['titulo_registro'];
                                //echo $nombreDoc;
                                array_push($documentos, $nombreDoc);
                                }
                        $totalDocs = count($documentos);
                        for ($i=0;$i<=$totalDocs-1;$i++) {
                            //echo $documentos[$i]."</br>";
                        echo "<input type='checkbox' name='documento[]' value=   '".$documentos[$i]."'   /> "       .$documentos[$i].  "<br>";
                         }
                         echo "<input type='submit' id= 'añadir_existente' name='añadir_existente' value='añadir a la ruta'/></br>";
}
?>   
</form>
 <?php
    if(isset($_POST['añadir_existente'])){
        if(isset($_POST['documento'])){
            
            foreach ($_POST['documento'] as $doc){  
                        echo $doc."dooc"."<br>";
            }
            
            $querymaterial_id= "SELECT material_id FROM documento WHERE titulo_registro='$doc'";
            $resultmaterial_id= mysql_query($querymaterial_id,$conexion) or die("que no que no.");
            while ($resultado = mysql_fetch_assoc($resultmaterial_id)) {
                                    $material_id = $resultado['material_id'];
                                    echo $material_id."iddd"."</br>";
             }
                                    
            $selRutaId="SELECT ruta_id FROM ruta WHERE (usuari_nombre= '$usuario') ORDER BY fechaRuta DESC LIMIT 1";
            $resultRutaId = mysql_query($selRutaId,$conexion) or die("que no que no selecciono rutaID.");
            while ($resultado = mysql_fetch_assoc($resultRutaId)) {
                                    $rutaId = $resultado['ruta_id'];
                                    echo $rutaId."RutaId"."</br>";
            }
                                    
                                    $rutaDoc="INSERT INTO rutaDoc (ruta_id, material_id) VALUES ('$rutaId','$material_id')";
                                    mysql_query($rutaDoc,$conexion) or die("que no que no inserto rutaDoc.");
                                    
                                    $selHitosRuta="SELECT material_id FROM rutaDoc WHERE (ruta_id= '$rutaId') ORDER BY fecha_ruta ASC";
                                    $resulHitosRuta = mysql_query($selHitosRuta,$conexion) or die("que no que no selecciono hitos ruta.");
                                            $hitos = Array();
                                            while ($resultado = mysql_fetch_assoc($resulHitosRuta)) {
                                                        $hito = $resultado['material_id'];
                                                        echo $hito;
                                                        array_push($hitos, $hito);
                                                        }
                                                        $totalHitos = count($hitos);
                                                        $longitudHitos = Array();
                                                        $latitudHitos = Array();
                                            for($i=0; $i<$totalHitos; $i++){
                                                $selLongLat="SELECT longitud, latitud FROM documento WHERE (material_id= '$hitos[$i]')";
                                                $resulselLongLat = mysql_query($selLongLat,$conexion) or die("que no que no selecciono long/lat hitos ruta.");
                                                }
                                                while ($resultado = mysql_fetch_assoc($resulselLongLat)) {
                                                    $longitudesHitos= $resultado['longitud'];
                                                    echo $longitudesHitos."LOOOOOOOONG"."</br>";
                                                    array_push($longitudHitos, $longitudesHitos);
                                                    $latitudesHitos= $resultado['latitud'];
                                                    echo $latitudesHitos."LAAAAAAAT"."</br>";
                                                    array_push($latitudHitos, $latitudesHitos);
                                                    }
                                                    //$hitosJson = json_encode($hitos);
                                                    $longitudesJson = json_encode($longitudHitos);
                                                    $latitudesJson = json_encode($latitudHitos);
 ?>                                                   
<script language="JavaScript" type="text/javascript">
    //var hitosJs = eval(<?php echo $hitosJson; ?>);
    var latitudesJs= eval(<?php echo $latitudesJson; ?>);
    var latitudesJs= eval(<?php echo $latitudesJson; ?>);
    //var selectedradiosJs= eval(<?php echo $selectedradiosJson; ?>);
</script>
  <?php                                           
        }
    }


?>


<form name="añadirNuevo" id="añadirNuevo" enctype="multipart/form-data" method="post"> <!--onSubmit="Coordenadas();">-->

<input type="submit" name="introducir" value="añadir nuevo"/>

                                            <!--<input name="longitud" id="longitud" type="hidden" value=""/>
                                            <input name="latitud" id="latitud" type="hidden" value=""/>
                                            <input type="submit" name="grabar ruta" value="grabar ruta"/> -->


                                           


<?php
   if(isset($_POST['introducir'])){     
 ?>
       <!-- <FORM name="formulario" id="formulario" enctype="multipart/form-data" method="post" onSubmit="Coordenadas();"> -->
                <p> <span class="texto">_Documento </span> <input type="file" name="archivo" size="30"></p>
                
                <p> <span class="texto">_Título</span> <input type="text" name="nombre_archivo" ></p>
                
                <p> <span class="texto"></span> <input type="hidden" name="usuari" > </p>
                
                <p> <span class="texto">_Fecha   [xxxx-xx-xx]</span> <input type="text" name="fecha_mat" > </p>
                
                <p> <span class="texto">_URL (clips)</span> <input type="text" name=" URL" size="50" maxlength=	"2000" > </p>
                
                <p> <span class="texto">_Descripcion</span> <input type="text" name="descripcion" size="50" maxlength="2000" > </p>
                
                <p> <span class="texto">_tipo</span>
                    <div id "radios"  style="overflow: hidden; width: 600; height:60">                     
                        <input type="Radio" name="selectedradio" value= 'foto'>Foto <img src="images/icono_foto.png" alt="foto"  />
                        <input type="Radio" name="selectedradio" value= 'video'>Video <img src="images/icono_video.png" alt="video"  />
                        <input type="Radio" name="selectedradio" value= 'texto'>Texto <img src="images/icono_texto.png" alt="texto" />
                        <input type="Radio" name="selectedradio" value= 'audio'>Audio <img src="images/icono_audio.png" alt="audio" />
                        <input type="Radio" name="selectedradio" value= 'clip'>Clip <img src="images/icono_clip.gif" alt="clip" />  </p>
                    </div>
                    </br>
                <p> <span class="texto">_Tema</span>
                    <select class="texto" name= "tema" id="tema" onChange="showCheck(this);">
                            <option value="SanFrancisco"> San Francisco</option>
                            <option value="BilbaoLaVieja"> Bilbao la Vieja</option>
                            <option value="Zabala"> Zabala</option> </p>
          
                    </select>
                    
                <p> <span class="texto">_Tags</span></p>
                <div id="cajaTags"  style="float: left; width: 170px; height: 100px; overflow: auto; border: 1px solid black;" scroll: "yes">                
                <?php 
                         $consulta_pestañasTag = "SELECT nombre_tag FROM tag ORDER BY nombre_tag ASC" ;
                         $resultTag = mysql_query($consulta_pestañasTag,$conexion);
                               if (!$resultTag) {
                                    $error=mysql_error($conexion);
                                    echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $consulta_pestañasTag")."<br>";
                                }
        
                        $tags=  array();
                                while ($resultado = mysql_fetch_assoc($resultTag)) {
                                $nombreTag = $resultado['nombre_tag'];
                                array_push($tags, $nombreTag);
                                }
                            $totalTags = count($tags);
                            for ($i=0;$i<=$totalTags-1;$i++) {
                                //echo $tags[$i]."</br>";
                            echo "<input type='checkbox' name='tag[]' value=   '".$tags[$i]."'   /> "       .$tags[$i].  "<br>";
                             }
                  ?>
                </div>
                
                </br>
                </br>
                </br>
                </br>
                </br>
                </br>
                
                <div>
                     
                    <p class="enlace_nuevoTag">crear nuevo tag

                     <input type='text' name='tagnuevo1'/><input type='text' name='tagnuevo2'/><input type='text' name='tagnuevo3'/></p>

                </div>
                
                </br>
                </br>
                <p><input name="longitud" id="longitud" type="hidden" value=""/></p>
                <p><input name="latitud" id="latitud" type="hidden" value=""/></p>
                <p><input type="submit" name="Guardar" class="botones" value="Guardar material" size="100"/></p>
                
                                      
</FORM>

<?php

}
                                            $longitud = $_POST['longitud'];
                                            $longitudes= explode(",", $longitud);
                                            $latitud = $_POST['latitud'];
                                            $latitudes= explode(",", $latitud);



                                            $totalLongitudes=count($longitudes);
                                            //for($i=0;$i<$totalLongitudes;$i++){
                                                //echo $longitudes[0]."long"."</br>";
                                                //echo $latitudes[0]."lat"."</br>";
                                                //}


    if (isset($_POST['Guardar'])) {
        
        $binario_titulo=$_FILES['archivo']['name'];
        $binario_peso=$_FILES['archivo']['size'];
        $binario_tipo=$_FILES['archivo']['type'];
        
        $nombre=$_POST['nombre_archivo'];
        $usuari = $_POST['usuari'];
        $fecha_mat = $_POST['fecha_mat'];
        $URL=$_POST['URL'];
        $descripcion=$_POST['descripcion'];
        
        $selectedradio = $_POST['selectedradio'];
        $tema=$_POST['tema'];
        $tag=$_POST['tag'];
        $tagnuevo = array();
        $tagnuevo[0]=$_POST['tagnuevo1'];
        $tagnuevo[1]=$_POST['tagnuevo2'];
        $tagnuevo[2]=$_POST['tagnuevo3'];

        $longitu=$longitudes[0];
        $latitu=$latitudes[0];
        echo $longitudes[0]."long"."</br>";
        echo $latitudes[0]."lat"."</br>";
    
        if(!empty($_REQUEST['Guardar'])){
        
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
            
                $consulta_insertarConTags = "INSERT INTO documento (titulo_registro, peso, extension, descripcion, nombre_archivo, longitud, latitud, URL, selectedradio, tema, tag, usuari,fecha_material) VALUES 
                ('$nombre', '$binario_peso', '$binario_tipo','$descripcion','$binario_titulo', '$longitu','$latitu','$URL', '$selectedradio','$tema', '$cadenaTags', '$usuari','$fecha_mat')";
                mysql_query($consulta_insertarConTags,$conexion) or die("que no que no tags.");
                

                }else{
                    $consulta_insertar = "INSERT INTO documento (titulo_registro, peso, extension, descripcion, nombre_archivo, longitud, latitud, URL, selectedradio, tema, tag, usuari,fecha_material) VALUES 
                    ('$nombre', '$binario_peso', '$binario_tipo','$descripcion','$binario_titulo', '$longitu','$latitu','$URL', '$selectedradio','$tema', '$tag[0]', '$usuari', '$fecha_mat')";
                mysql_query($consulta_insertar,$conexion) or die("que no que no.");
                }
            
            
                                $querymaterial_id= "SELECT material_id FROM documento WHERE titulo_registro='$nombre'";
                                $resultmaterial_id= mysql_query($querymaterial_id,$conexion) or die("que no que no.");
                                while ($resultado = mysql_fetch_assoc($resultmaterial_id)) {
                                                    $material_id = $resultado['material_id'];
                                                    echo $material_id."iddd"."</br>";
                                }
                                
                                $selRutaId="SELECT ruta_id FROM ruta WHERE (usuari_nombre= '$usuario') ORDER BY fechaRuta DESC LIMIT 1";
                                $resultRutaId = mysql_query($selRutaId,$conexion) or die("que no que no ruta_id.");
                                    while ($resultado = mysql_fetch_assoc($resultRutaId)) {
                                            $rutaId = $resultado['ruta_id'];
                                            echo $rutaId."RutaId"."</br>";
                                    }
                                
                                $rutaDoc="INSERT INTO rutaDoc (ruta_id, material_id) VALUES ('$rutaId','$material_id')";
                                mysql_query($rutaDoc,$conexion) or die("que no que no rutaDoc.");
        }
    }

    ?>
</body>
</html>