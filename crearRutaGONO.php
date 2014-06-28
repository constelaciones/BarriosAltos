<?php
session_start();
include("conecta.php");
$usuari = $_SESSION["nombreusuari"];
echo "USUARI:  ".$usuari."</br>";
echo "RUTA: ".$_POST['nombre_ruta']."</br>";
?>
<?php
if (isset($_POST['nombre_ruta'])) {
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
    
    ?>
    <input type="button" name="insertar_nuevo" id="insertar_nuevo" value="insertar nuevo" onclick="Enviar('insertar_archivoRuta.php','insertarCrearRuta'); posicionar2()"/>
    <!--<input type="button" name="seleccionar_existente" id="seleccionar_existente" value="seleccionar existente" onclick="Enviar('seleccionarExistente_archivoRuta.php','seleccionarExistenteCrearRuta')"/>-->
    <?php
    }
    }else{
    echo "falta introducir la información de la rutas!";
    }
    }
?>