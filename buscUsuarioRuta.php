<?php
session_start();
include("conecta.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div id="buscador por usuario">  
        <form name="buscUsuario" method="post">
            <h4>Buscar por usuarix</h4>

                <select name="usuarios" onclick="showUsersRuta(this.value)">
                <option value="">Selecciona usuarix:</option>
                    <?php 
                        $consulta_pestañasUsuario = "SELECT nombre FROM usuari ORDER BY nombre ASC" ;
                        $resultUsuario = mysql_query($consulta_pestañasUsuario,$conexion);
                            if (!$resultUsuario) {
                                $error=mysql_error($conexion);
                                echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $consulta_pestañasUsuario")."<br>";
                            }
        
                        
                        //$row = mysql_fetch_row($consulta_insertar);
                        $usuarios=  array();
                        while ($resultado = mysql_fetch_assoc($resultUsuario)) {
                            $nombreUsuario = $resultado['nombre'];
                            array_push($usuarios, $nombreUsuario);
                        }
                        $totalUsuarios = count($usuarios);
                            for ($i=0;$i<=$totalUsuarios;$i++) {
                            //echo $tags[$i]."</br>";
                            echo "<option value=   '".$usuarios[$i]."'   /> "       .$usuarios[$i].  "</option>";
                            }
                        
                        ?>
                </select>
        </form>
    <div id="resultadosUsuarioRuta"></div>
    </div>