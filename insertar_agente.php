<?php
session_start();
include("conecta.php");

    if (isset($_SESSION['nombreusuari'])) {
   ?>     
                            <form name="añadirNuevoAgente" id="añadirNuevoAgente" enctype="multipart/form-data" method="post">
                                
                                Haz click en el mapa donde quieras posicionar un nuevo colectivo.
                                </br>
                                <p><input type="text" name="longitud" value='' readonly></p>
                                <p><input type="text" name="latitud" value="" readonly></p>
                                
                                <p> <span class="texto">Foto perfil </span> <input type="file" name="foto" id="foto" size="30"></p>
                
                                <p> <span class="texto">_Nombre</span> <input type="text" name="nombre" ></p>
                                
                                <p> <span class="texto"></span> <input type="hidden" name="usuari" > </p>
                                
                                <p> <span class="texto">_URL</span> <input type="text" name=" URL" size="auto" maxlength="2000" > </p>
                                
                                <p> <span class="texto">_Descripcion</span> <textarea type="text" name="descripcion" rows="7" cols="30" size="auto" maxlength="2000" ></textarea> </p>
                                
                                <p> <span class="texto">_tipo</span>
                                     <div id "radios"  style="overflow: hidden; width: 600; height:60">                     
                                        <input type="Radio" name="selectedradio" value= 'Persona'>Persona
                                        <input type="Radio" name="selectedradio" value= 'Vecinx'>Vecinx </br>
                                        <input type="Radio" name="selectedradio" value= 'Asociación'>Asociación
                                        <input type="Radio" name="selectedradio" value= 'Colectivo'>Colectivo</br>
                                        <input type="Radio" name="selectedradio" value= 'Plataforma'>Plataforma
                                        <input type="Radio" name="selectedradio" value= 'Transeunte'>Transeunte</br>
                                        <input type="Radio" name="selectedradio" value= 'Objeto cultural no identificado'>Objeto cultural no identificado
                                    </div>
                                    
                                <!--<p> <span class="texto">_Tema</span>
                                    <select class="texto" name= "tema" id="tema" onChange="showCheck(this);">
                                            <option value="SanFrancisco"> San Francisco</option>
                                            <option value="BilbaoLaVieja"> Bilbao la Vieja</option>
                                            <option value="Zabala"> Zabala</option> </p>
                          
                                    </select>-->
                                    
                                <p> <span class="texto">_Tags</span></p>
                                <div id="cajaTags"  style="float: left; width: 170px; height: 100px; overflow: auto; border: 1px solid black;" scroll: "yes">                
                                <?php 
                                         $consulta_pestañasTag = "SELECT tagAgente_nombre FROM tagAgente ORDER BY tagAgente_nombre ASC" ;
                                         $resultTag = mysql_query($consulta_pestañasTag,$conexion);
                                               if (!$resultTag) {
                                                    $error=mysql_error($conexion);
                                                    echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $consulta_pestañasTag")."<br>";
                                                }
                        
                                        $tags=  array();
                                                while ($resultado = mysql_fetch_assoc($resultTag)) {
                                                $nombreTag = $resultado['tagAgente_nombre'];
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
                                </br>

                                <div>
                                     
                                    <p class="enlace_nuevoTag">Crear nuevo Tag
                                    </br>

                                     <input type='text' name='tagnuevo1'/><input type='text' name='tagnuevo2'/><input type='text' name='tagnuevo3'/></p>

                                </div>
                                
                                </br>
                                <!--<p><input name="longitud" id="longitud" type="hidden" value=""/></p>
                                <p><input name="latitud" id="latitud" type="hidden" value=""/></p>-->
                                <p><input type="button" name="Guardar" value="Guardar material" size="100" onclick=" borrarMarcadorInsertarAgente() ; uploadAjaxAgente()"/></p>
                    </form>

<?php
}else{
 echo "Necesitas logearte para añadir un agente..." ;
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


?>