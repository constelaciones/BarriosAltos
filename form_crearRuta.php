<?php
session_start();
include("conecta.php");
    if (isset($_SESSION['nombreusuari'])) {
?>

<form name="info_ruta" id="info_ruta" method="post">
            <p>Nombre de la Ruta<input type="text" name="nombre_ruta" id="nombre_ruta"/></p>
            <p>Descripción<input type="text" name="descripción" id="descripción"/></p>
            <p><input type="button" name="crear_ruta" id="crear_ruta" value="crear_ruta" onclick="PasarFormRuta()"/> </p>
            
</form>
<?php
}else{
 echo "Necesitas logearte para crear una ruta..." ;
}
?>