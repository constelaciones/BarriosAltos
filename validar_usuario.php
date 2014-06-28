<?php
session_start();
include("conecta.php");
//function quitar($mensaje)
//{
//	$nopermitidos = array("'",'\\','<','>',"\"");
//	$mensaje = str_replace($nopermitidos, "", $mensaje);
//	return $mensaje;
//}
//echo $_GET["nombre"]."nombre"."</br>";
//echo $_GET["clave"]."clave"."</br>";
if(($_GET["nombre"]) != "" && ($_GET["clave"]) != "")
{
	// Puedes utilizar la funcion para eliminar algun caracter en especifico
	//$nombre = strtolower(quitar($HTTP_POST_VARS["nombre"]));
	//$clave = $HTTP_POST_VARS["clave"];
	// o puedes convertir los a su entidad HTML aplicable con htmlentities
	//$nombre = strtolower(htmlentities($_POST["nombre"], ENT_QUOTES));
        $nombre = $_GET["nombre"];
	$clave = $_GET["clave"];
	$query =  "SELECT clave, nombre FROM usuari WHERE nombre= '$nombre'";
        $result = mysql_query($query, $conexion);
        if(!$result){
          $error = mysql_error($conexion);
          echo"Se ha producido un error al ejecutar la consulta";   
            }
        
	while($registro = mysql_fetch_object($result)){
            $nombreComprobado = $registro -> nombre;
            $claveComprobada = $registro -> clave;
            }
            
            if($nombreComprobado == $nombre){
                
		if($claveComprobada == $clave){
			$_SESSION["nombreusuari"] = $nombreComprobado;
			echo 'Has sido logueado correctamente '.$_SESSION['nombreusuari'].' <p>';
                        //header("Location: principal.html");
                        ?>
                        <p><a href="javascript:Enviar('logout.php','mostrar_login')">Log out</a></p>
                        <?php
                        
		}else{
			echo 'Clave incorrecta';
		}
	}else{
		echo 'Usuarix no existente en la base de datos';
	}
	mysql_free_result($result);
}else{
	echo 'Debe especificar un usuarix y contraseña';
}
mysql_close();
?>