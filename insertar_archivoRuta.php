<?php
session_start();
include("conecta.php");
    if (isset($_SESSION)) {
   ?>     
                            <form name="añadirNuevoArchivoRuta" id="añadirNuevoArchivoRuta" enctype="multipart/form-data" method="post">
                                
                                clicka en el mapa donde quieras posicionar tu documento
                                </br>
                                <p><input type="text" name="longitudRuta" value='' readonly></p>
                                <p><input type="text" name="latitudRuta" value="" readonly></p>
                                
                                <p> <span class="texto">_Documento </span> <input type="file" name="archivo" size="30"></p>
                
                                <p> <span class="texto">_Título</span> <input type="text" name="nombre_archivo" ></p>
                                
                                <p> <span class="texto"></span> <input type="hidden" name="usuari" > </p>
                                
                                <!--<p> <span class="texto">_Fecha   [xxxx-xx-xx]</span> <input type="text" name="fecha_mat" > </p>
                                
                                <p> <span class="texto">_URL (clips)</span> <input type="text" name=" URL" size="50" maxlength=	"2000" > </p>-->
                                
                                <p> <span class="texto">_Descripcion</span> <input type="text" name="descripcion" size="50" maxlength="2000" > </p>
                                
                                <p> <span class="texto">_tipo</span>
                                    <div id "radios"  style="overflow: hidden; width: 600; height:60">                     
                                        <input type="Radio" name="selectedradio" value= 'foto'>Foto <img src="images/icono_foto.png" alt="foto"  />
                                        <input type="Radio" name="selectedradio" value= 'video'>Video <img src="images/icono_video.png" alt="video"  />
                                        <input type="Radio" name="selectedradio" value= 'texto'>Texto <img src="images/icono_texto.png" alt="texto" />
                                        <input type="Radio" name="selectedradio" value= 'audio'>Audio <img src="images/icono_audio.png" alt="audio" />
                                        <input type="Radio" name="selectedradio" value= 'clip'>Clip <img src="images/icono_clip.gif" alt="clip" />  </p>
                                    </div>
                                    </br>
                                <!--<p> <span class="texto">_Tema</span>
                                    <select class="texto" name= "tema" id="tema" onChange="showCheck(this);">
                                            <option value="SanFrancisco"> San Francisco</option>
                                            <option value="BilbaoLaVieja"> Bilbao la Vieja</option>
                                            <option value="Zabala"> Zabala</option> </p>
                          
                                    </select>-->
                                    
                                <p> <span class="texto">_Tags</span></p>
                                <div id="cajaTags"  style="float: left; width: 170px; height: 100px; overflow: auto; border: 1px solid black;" scroll: "yes">                
                                <?php 
                                         $consulta_pestañasTag = "SELECT nombre_tag FROM tag ORDER BY nombre_tag ASC" ;
                                         $resultTag = mysql_query($consulta_pestañasTag,$conexion);
                                               if (!$resultTag) {
                                                    $error=mysql_error($conexion);
                                                    echo ("Se ha producido un error al ejecutar la query.<br>MySQL dice: $error<br>La query era: $consulta_pestañasTag")."<br>";
                                                }
                        
                                        $tags=  array();
                                                while ($resultado = mysql_fetch_assoc($resultTag)) {
                                                $nombreTag = $resultado['nombre_tag'];
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
                                     
                                    <p class="enlace_nuevoTag">crear nuevo tag
                                    </br>

                                     <input type='text' name='tagnuevo1'/><input type='text' name='tagnuevo2'/><input type='text' name='tagnuevo3'/></p>

                                </div>
                                
                                </br>
                                </br>
                                <!--<p><input name="longitud" id="longitud" type="hidden" value=""/></p>
                                <p><input name="latitud" id="latitud" type="hidden" value=""/></p>-->
                                <p><input type="button" name="Guardar_materialRuta" value="Guardar material" size="100" onclick="PasarFormInsertarRuta()"/></p>
                    </form>

<?php
}else{
 echo "Necesitas logearte para añadir un archivo..." ;
}

                                            $longitud = $_POST['longitudRuta'];
                                            $longitudes= explode(",", $longitud);
                                            $latitud = $_POST['latitudRuta'];
                                            $latitudes= explode(",", $latitud);



                                            $totalLongitudes=count($longitudes);
                                            //for($i=0;$i<$totalLongitudes;$i++){
                                                //echo $longitudes[0]."long"."</br>";
                                                //echo $latitudes[0]."lat"."</br>";
                                                //}


?>