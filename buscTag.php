<?php
session_start();
include("conecta.php");
?>

<div id="buscador por tag">
    <form name="buscTag" method="post">
        <h4>Buscar por tag</h4>
            <div>
                <div id="v1"  style="float: left; width: 170px; height: 100px; overflow: auto; border: 1px solid black; position: relative;">
                    <?php 
                        $consulta_pestañasTag = "SELECT nombre_tag FROM tag ORDER BY nombre_tag ASC" ;
                        $resultTag = mysql_query($consulta_pestañasTag,$conexion);
                            if (!$resultTag) {
                                $error=mysql_error($conexion);
                                echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $consulta_pestañasTag")."<br>";
                            }
            
                        //$row = mysql_fetch_row($consulta_insertar);
                        $tags=  array();
                            while ($resultado = mysql_fetch_assoc($resultTag)) {
                                $nombreTag = $resultado['nombre_tag'];
                                array_push($tags, $nombreTag);
                            }
                            $totalTags = count($tags);
                            for ($i=0;$i<=$totalTags-1;$i++) {
                                //echo $tags[$i]."</br>";
                                echo "<input type='checkbox' name='tag' value=   '".$tags[$i]."'   /> "       .$tags[$i].  "<br>";
                            }
                    ?>
                </div>
                <input type="button" name="submitTag" value="Buscar" onClick="ShowInfoTags()"/>
                <br><br><br><br><br><br>
            </div>
    </form>
</div>

<div id="resultadosTags"></div>