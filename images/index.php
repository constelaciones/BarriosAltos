<?php
session_start();
include("conecta.php");
?>
<HTML>
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <TITLE>Constelaciones</TITLE>
    <link href="images/faviconWeb.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/tabs.css" type="text/css">
    <link rel="stylesheet" href="css/layout-default-latest.css"> <!-- botón toggler -->
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/docs.css">
    <link rel="stylesheet" href="css/jquery.ui.all.css">
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script src="js/jquery-1.3.2.js"></script>
    <script src="js/map.js"></script>
    <script src="js/login.js"></script>
    <SCRIPT type="text/javascript" src="js/jquery.layout.js"></SCRIPT>
    <script src="js/jquery.ui.all.js"></script> <!-- importante -->
    <script src="js/jquery.ui.core.js"></script>
    <script src="js/jquery.ui.button.js"></script>
    <script src="js/jquery.ui.widget.js"></script>
    <script src="js/jquery.effects.core.js"></script>
    <script src="js/jquery.ui.accordion.js"></script>
    <script src="js/jquery.ui.accordion2.js"></script> <!-- necesario para el 2o acordeón -->
    <script src="js/jquery.ui.tabs.js"></script>
    <script src="js/jquery.ui.datepicker.js"></script> <!-- necesario para calendario -->
    <script src="js/ajax.js"></script> <!-- cargar contenido en div -->
    <script src="js/ajax2.js"></script> <!-- pestañas -->
    <script src="js/ajax3.js"></script> <!-- validar usuario -->
    <script src="js/registro.js"></script> <!--registro-->
    <script src="js/ajax4.js"></script> <!-- busc.tipo de documento (desplegable) -->
    <script src="js/ajax5.js"></script> <!-- busc. por Area -->
    <script src="js/ajax6.js"></script> <!-- busc. por Tag -->
    <script src="js/ajax7.js"></script> <!-- busc. por Usuari -->
    <script src="js/ajax8.js"></script> <!-- busc. por Fecha -->
    <script src="js/ajax9.js"></script> <!-- buscador general -->
    <script src="js/verTodo.js"></script> <!-- ver todos archivos en el mapa -->
    <script src="js/ocultarTodo.js"></script><!-- ocultar todos archivos en el mapa -->
    <script src="js/valoresRuta.js"></script><!-- pasar valores ruta a la funcion verRuta -->
    <script src="js/verRuta.js"></script><!-- ver Ruta -->
    <script src="js/ocultarRuta.js"></script>
    <script src="js/posicionarElemento.js"></script>
    <script src="js/valoresInsertar.js"></script>
    <script src="js/valoresFormRuta.js"></script>
    <script src="js/calendario.js"></script>
    <script src="js/valoresArchivosSelec.js"></script>
    <script src="js/upload.js"></script>
    <script src="js/pasarIdDoc.js"></script>
    <script src="js/tabs.js"></script>
    
    <script type="text/javascript">
        function showUser(str)
        {
        if (str=="")
          {
          document.getElementById("txtHint").innerHTML="";
          return;
          } 
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","bTema.php?q="+str,true);
        xmlhttp.send();
        }
    </script>

    <SCRIPT type="text/javascript">
        function updateMap(paneName) {
            map.updateSize();
            if (window.console) console.log("RESIZE");
        }
        
        $(document).ready(function () {
                $('body').layout({ 
                    applyDefaultStyles: true, 
                    onopen_end: updateMap,
                    onclose_end: updateMap
                });
                
                $("#buscador_form").submit(function(){
                    var valor=$("#input_busqueda").val();
                    console.log(valor);
                    showBusqueda(valor);
                    return false;
                });
        });
    </SCRIPT>
    
    <script>
	$(function() {
		$( "#accordion" ).accordion({
			<!-- fillSpace: true
		});
                $( "#accordion2" ).accordion2({
			<!-- fillSpace: true
		});
	});
    </script>


</HEAD>
    <BODY onLoad="init();">
        <DIV class="ui-layout-center">
            <!--<div id= "resultadosBusqueda2"></div>-->
            <div id= "basicMap"></div>
        </DIV>
        <DIV class="ui-layout-north"><img src="images/constelaciones_logo.png" title="CONSTELACIONES" style="margin-top:-48px; margin-left:-15px; position: absolute;">

            <div id= "usuari">
                <div id ="signin_btn">
                    <a href="#login-box2" class="login-window">REGISTRO</a>
                </div>
                <div id="login_btn">
                    <a href="#login-box" class="login-window">LOGIN</a>
                </div>
            </div>
        </DIV>
        <!------------------------------------------------------------------------------------------------------------->
        <!-- LOGIN -->
        <div id="login-box" class="login-popup">
            <a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
            
            <form action="validar_usuario.php" method="post" class="signin">
                <fieldset class="textbox">
                    <label class="username">
                        <span>Usuarix</span>
                        <input type="text" name="nombre" id="nombre" maxlength="20" autocomplete="on" placeholder="Usuarix"/>
                        <br />
                    </label>
                    <label class="password">
                        <span>Contraseña</span>
                        <input type="password" name="clave" id="clave" maxlength="10" placeholder="Contraseña"/>
                        <br />
                    </label>
                    <label class="password">
                        <input class="submit button" type="button" value="Login" onClick="showLogin()"/>
                        <br />
                        <!--<button class="submit button" type="button">Registro</button>-->
                    </label>
            <div id="txtValidar"></div>
                <?php
                    if (!isset($_SESSION['nombreusuari'])) {
                        echo $_SESSION['nombreusuari']."No hay sesión";
                        ?> <?php
                    }else {
                        echo $_SESSION['nombreusuari'];
                        
                ?>
                <label class="username">
                    <input class="submit button" type="button" onClick="javascript:Enviar('logout.php','mostrar_login')"/>Log out
                    <br />
                </label>
                <?php
                    }
                ?>
                <div id= "mostrar_login"></div>
                </fieldset>
            </form>
        </div><!-- end login-box -->
        
        <!-- REGISTRO -->
        <div id="login-box2" class="login-popup">
            <form class="signin">
                <fieldset class="textbox">
                <label class="username">
                <span>Usuarix</span>
                        <input type="text" name="username" id="username"size="20" maxlength="20" autocomplete="on" placeholder="Usuarix"/><br/>
                        <br />
                </label>
                <label class="password">
                <span>Contraseña (max 10)</span>
                    <input type="password" name="clave" id="clave" size="10" maxlength="10" placeholder="Contraseña"/>
                    <br />
                </label>
                <label class="password">
                <span>Confirma</span>
                    <input type="clave" name="clave2" id="clave2" size="10" maxlength="10" placeholder="Confirma"/><br/>
                    <br />
                </label>
                <label>
                <span>Correo (max 40)</span>
                    <input type="text" name="mail" id="mail" size="20" maxlength="40" placeholder="Correo"/><br />
                    <br />
                </label>
                <label>
                    <input class="submit button" type="button" value="Registrar" onClick="showRegistro()" />
                    <br />
                </label>
                
                
            <div id="registrado"></div>
                
                <?php
                    if (!isset($_SESSION['nombreusuari'])) {
                        ?> <!-- llamada de resgitro_forma aquí eliminada --><?php
                    }
                ?>
                
                </fieldset>
            </form>
            <div id= "documentos_sesionUsuari"></div>
            
        </div><!-- end login-box -->
        <!--------------------------------------------------------------------------------------------------------------->
        
        <DIV class="ui-layout-south">South</DIV>
        <DIV class="ui-layout-east">

            <p>EDITAR</p>
                
                <div id="accordion2" style="width:100%; height:auto;">
                    <h3><a href="#">AÑADIR ARCHIVO</a></h3>
                        <div> <!--EDICIÓN-->
                            <input type="button" name="insertar_nuevo_archivo" id="insertar_nuevo_archivo" value="insertar nuevo archivo" onClick="posicionar(); Enviar('insertar_archivo.php','mostrar_insertar'); calendario()"/>
                            <div id= "mostrar_insertar"></div>
                            <div id= "insertar"></div>
                            <div id="output"></div>
                        </div>
                    <h3><a href="#">CREAR RUTA</a></h3>
                        <div> 
                            <input type="button" name="crearRuta" id="crearRuta" value="crear ruta" onClick="Enviar('form_crearRuta.php','mostrar_form_crearRuta')"/>
                            <div id= "mostrar_form_crearRuta"></div>
                            <div id= "info_crearRuta"></div>
                            <div id= "insertarCrearRuta"></div>
                            <div id= "seleccionarExistenteCrearRuta"></div>
                        </div>
                    <h3><a href="#">CONFLUENCIAS</a></h3>
                        <div> <!--A-->
                            <p>En construcción! </br>
                             Disculpen las molestias ;) </p>
                            <img src="images/En_Construccion.jpg" title="En Construcción">
                        </div>
                </div><!-- End accordion2 -->      
        </div>
        </DIV>
        
        <DIV class="ui-layout-west">
            
            <p>NAVEGAR</p>
                <div id="accordion" style="width:100%; height:auto;">
                    <h3><a href="#">BUSCADOR</a></h3>
                        <div> <!--A partir de aquí el menú-->
                            <form>
                                <input type="text" name="busqueda"></input>
                                <input type="button" value="Buscar" onclick="showBusqueda(busqueda.value)"></input>

                                <!--<a href="#login-box2" class="login-window">REGISTRO</a-->                                
                            </form>
                            <div id="resultadosBusqueda"></div>
                                <div id="container-pestanhas">
                                    <div id="pestanhas">
                                        <ul class="menu">
                                            <li id="pestanha1" class="active">DOCUMENTO</li>
                                            <li id="pestanha2">RUTAS</li>
                                        </ul>
                                        <span class="clear"></span>
                                        <div class="content pestanha1"> <!-- DOCUMENTO -->
                                        <div onload="activeTab(1);">
                                            <div id ="content-tabmenu">
                                                <br>
                                                <ul id="tabmenu" >
                                                    <li onClick="activeTab(1)"><a class="" id="tab1">Lista</a></li>
                                                    <li onClick="activeTab(2)"><a class="" id="tab2">Tipo</a></li>
                                                    <li onClick="activeTab(3)"><a class="" id="tab3">Área</a></li>
                                                    <li onClick="activeTab(4)"><a class="" id="tab4">Tag</a></li>
                                                    <li onClick="activeTab(5)"><a class="" id="tab5">Usuarix</a></li>
                                                    <li onClick="activeTab(6)"><a class="" id="tab6">Fecha</a></li>
                                                </ul>
                                                
                                                <div id="content"></div>
                                            </div>
                                            </div> <!--end activeTab-->
                                        </div><!--end content pestanha1-->
                                            
                                        <div class="content pestanha2"> <!-- RUTA -->
                                            <div id ="content-tabmenu">
                                                <br>
                                                <ul id="tabmenu" >
                                                    <li onClick="activeTab(1)"><a class="" id="tab1">Lista</a></li>
                                                    <li onClick="activeTab(2)"><a class="" id="tab2">Tipo</a></li>
                                                    <li onClick="activeTab(3)"><a class="" id="tab3">Área</a></li>
                                                    <li onClick="activeTab(4)"><a class="" id="tab4">Tag</a></li>
                                                    <li onClick="activeTab(5)"><a class="" id="tab5">Usuarix</a></li>
                                                    <li onClick="activeTab(6)"><a class="" id="tab6">Fecha</a></li>
                                                <ul>

                                                <div id="content"></div>
                                            </div>
                                        </div><!--end content pestanha2-->
                                    </div> <!--end pestanhas-->
                                </div> <!--end container-pestanhas-->
                            
                        </div>
                     
                    <h3><a href="#">VER</a></h3>
                    <div>
                        
                        <?php
                         $sql = "SELECT material_id, longitud, latitud, selectedradio FROM documento ORDER BY fecha_inser DESC";
                                $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");
                                $datos = mysql_query($sql, $conexion);
                                
                                $markers=  array();
                                 while ($resultado = mysql_fetch_assoc($datos)) {
                                            $markers[]=$resultado;
                                }
                                $markersJson=json_encode($markers);
                         ?> 
                        <script language="JavaScript" type="text/javascript">
                            var markersdata=eval(<?php echo $markersJson; ?>);
                            //var longitudesJs = eval(<?php echo $longitudesJson; ?>);
                            //var latitudesJs= eval(<?php echo $latitudesJson; ?>);
                            //var selectedradiosJs= eval(<?php echo $selectedradiosJson; ?>);
                        </script>
                            
                            <form>
                                <input type="button" id="ver" value="ver archivos en el mapa" onClick="verTodo()"/>
                            </form>
                            <form>
                                <input type="button" id="ocultar" value="ocultar archivos en el mapa" onClick="ocultarTodo()"/>
                            </form>
                    </div>
                    
                    <h3><a href="#">VER RUTA</a></h3>
                    <div>
                        <form>
                            <input type="text" name="nombre_ruta" id="nombre_ruta"/>
                            <input type="button" name="buscarRuta" id="buscarRuta" value="Buscar" href="javascript:;" onClick="PasarNombreRuta($('#nombre_ruta').val());return false;"/>
                        </form>
                        <div id="ruta"></div>
                        
                        <form>
                            <input type="button" id="ocultar ruta" value="ocultar Ruta en el mapa" onClick="ocultarRuta()"/>
                        </form>
                    </div>

                </div><!-- End accordion -->
            
        </DIV>
        
    </BODY>
</HTML>