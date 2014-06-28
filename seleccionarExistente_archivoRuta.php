<?php
session_start();
include("conecta.php");
//$usuari = $_SESSION["nombreusuari"];
?>
    
    <form name="seleccionados" method="post">
<?php
//echo "aqui,aqui".  "<br>";
    $docsUsuario = "SELECT titulo_registro FROM documento WHERE usuari='$usuari' ORDER BY titulo_registro ASC" ;
    $resultDocs = mysql_query($docsUsuario,$conexion) or die("que no que no.");
    
    $documentos=  array();
                            while ($resultado = mysql_fetch_assoc($resultDocs)) {
                                $nombreDoc = $resultado['titulo_registro'];
                                //echo $nombreDoc.  "<br>";
                                array_push($documentos, $nombreDoc);
                                }
                        $totalDocs = count($documentos);
                        for ($i=0;$i<=$totalDocs-1;$i++) {
                            //echo "docs";
                            //echo $documentos[$i]."</br>";
                        echo "<input type='checkbox' name='documento' value=   '".$documentos[$i]."'   /> "       .$documentos[$i].  "<br>";  //onclick="" llamar funcion js; mediante ajax: llamar al php (que inserta y relaciona ruta_id con doc_id) pasandole los valores de los archivos seleccionados
                         }
?>  
                         <input type='button' id= 'añadir_existente' name='añadir_existente' value='añadir a la ruta' onClick="ShowInfoArchivosSelect()"/>
                         </form>
                         
                        <div id="archivosSeleccionados"></div>

 