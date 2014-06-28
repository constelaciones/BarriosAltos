<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$conexion = mysql_connect('localhost','montenoso3','xbxbohlc') or die("No se pudo realizar la conexion con el servidor.");
mysql_query("SET NAMES 'utf8'", $conexion);
mysql_select_db("montes_montenoso" ,$conexion) or die("No se puede seleccionar BD"); 
?>