<?php
session_start();
include("conecta.php");
    
   if (isset($_GET['id'])){
      $id = $_GET['id'];
      //echo "id: ".$id;
      
      
      $queryFicha = "SELECT * FROM agente WHERE agente_id = $id";
      
      $result = mysql_query($queryFicha,$conexion);
      
  if (!$result) {
     $error=mysql_error($conexion);
     die ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $query")."<br>";
   }
   
   while ($registro= mysql_fetch_object($result)) {
       $nombre = $registro->nombre;
       $descripción= $registro->descripcion;
       $tema = $registro-> tema;
       $tag = $registro-> tag;
       $url = $registro-> url;
       $extension = $registro-> tipo_foto;
       $nombreArchivo = $registro-> titulo_foto;
       ?>
       
        <div id="fichaAgente"><?php
           echo "Nombre: ".$nombre."</br>";
           echo "Descripción: ".$descripción."</br>";
           echo "Tema: ".$tema."</br>";
           echo "Tag: ".$tag."</br>";
           echo "url: ".$url; ?>
        
        <?php
       }
   
   }
   
   $nombre_fichero_sin_espacios=str_replace(" ","",$nombreArchivo);

   if($extension == "image/jpeg" || $extension == "image/png" || $extension == "image/gif" ){
?> <img src="uploadsAgentes/<?php echo $nombre_fichero_sin_espacios; ?>"/>
<?php }
    if($extension == "audio/x-wav"){
?>  <audio controls="controls" src="uploadsAgentes/<?php echo $nombre_fichero_sin_espacios; ?>"/></audio>
<?php }
    if($extension == "video/quicktime"){
?> <video controls="controls" src="uploadsAgentes/<?php echo $nombre_fichero_sin_espacios; ?>" ></video>
<?php }
?>
<input type="button" id="volver" value="volver al mapa" onClick="ocultarFichaAgente(); init()"></input>
</div>