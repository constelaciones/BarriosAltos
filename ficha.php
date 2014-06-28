<?php
session_start();
include("conecta.php");
    
   if (isset($_GET['id'])){
      $id = $_GET['id'];
      //echo "id: ".$id;
      
      
      $queryFicha = "SELECT * FROM documento WHERE material_id = $id";
      
      $result = mysql_query($queryFicha,$conexion);
      
  if (!$result) {
     $error=mysql_error($conexion);
     die ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $query")."<br>";
   }
   
   while ($registro= mysql_fetch_object($result)) {
       $titulo = $registro->titulo_registro;
       $descripción= $registro->descripcion;
       $tema = $registro-> tema;
       $tag = $registro-> tag;
       $nombre = $registro-> nombre_archivo;
       $extension = $registro-> extension;
       $selectedRadio = $registro-> selectedradio;
       ?>
       
        <div id="ficha"><?php
           echo "Título: ".$titulo."</br>";
           echo "Descripción: ".$descripción."</br>";
           echo "Tema: ".$tema."</br>";
           echo "Tag: ".$tag."</br>";
           echo "Nombre: ".$nombre."</br>"; ?>
            <br>
            
        <?php
       }
   
   }
   
   $nombre_fichero_sin_espacios=str_replace(" ","",$nombre);?> 
            
        <?php
   if($extension == "image/jpeg" || $extension == "image/png" || $extension == "image/gif" || $extension == "image/tiff"){
?> <img src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>"/>
    <br>
<?php }
    if($extension == "audio/x-wav" || $extension =="audio/mpeg"){
?>  <audio controls="controls" src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>"/></audio>
    <br>
<?php }
    if($extension == "video/quicktime" || $extension == "video/mp4"){
?> <video controls="controls" src="uploads/<?php echo $nombre_fichero_sin_espacios; ?>" ></video>
    <br>
<?php }
?>
    <br>
<input type="button" id="volver" value="volver al mapa" onClick="ocultarFicha(); init()"></input>
              
</div>