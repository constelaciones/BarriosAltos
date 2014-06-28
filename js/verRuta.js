var flag=0;
var positionMarker;
var iconos = new Array();
    iconos[0] = "images/icono_foto.png";
    iconos[1] = "images/icono_video.png";
    iconos[2] = "images/icono_audio.png";
    iconos[3] = "images/icono_texto.png";
    iconos[4] = "images/puntero.png";
    //iconos[4] = "iconos_png/";
var icono;
var map;
var size;
var offset;

var marcadoresLista = new Array();
var marcadoresListaRuta = new Array();
var nodo;
var nodoRuta;

//var markers = new OpenLayers.Layer.Markers();
          
function verRuta(){
    rutars = new OpenLayers.Layer.Markers( "Rutars" );
    rutars.id = "Rutars";
        //var longitudesJs = data.longitudes;
        //var latitudesJs= data.latitudes;
        //var selectedradiosJs= data.selectedradios;

        //document.write(selectedradiosJs[0]);
        //alert(longitudesJs[0]+"long");
        //alert(latitudesJs[0]+"lat");
    //console.log(longitudesJsRuta.length+"length");
    for(i=0; i< longitudesJsRuta.length;i++){
        console.log(longitudesJsRuta[i]+"long"+i);
        console.log(latitudesJsRuta[i]+"lat"+i);
        //alert(selectedradiosJs[i]+"radio"+i);
        console.log("yeah!!!");
        
        switch(selectedradiosJsRuta[i]){
            case "foto":
                icono = iconos[0];
                break;
            case "video":
                icono = iconos[1];
                break;
            case "audio":
                icono = iconos[2];
                break;
            case "texto":
                icono = iconos[3];
                break;
            default :
                icono = iconos[4];
            }
                        
        var icon = new OpenLayers.Icon(icono, size, offset);
        //alert("hola");
        
        var rutamarker = new OpenLayers.Marker(new OpenLayers.LonLat(longitudesJsRuta[i],latitudesJsRuta[i]),icon);
        
        rutamarker.lonlat=new OpenLayers.LonLat(longitudesJsRuta[i],latitudesJsRuta[i]);
        rutamarker.documentoId=material_idJsRuta[i];
        //newmarker.nombre = markersdata[i].titulo_registro;
        
        rutamarker.events.register('mouseover', rutamarker, function(evt) { console.log(this.documentoId); OpenLayers.Event.stop(evt);  });
        //newmarker.events.register('click', newmarker, markerClick);
        rutamarker.events.register('click', rutamarker, function(evt) { 
            
             if (this.documentoId=="")
  {
  document.getElementById("basicMap").innerHTML="";
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
    document.getElementById("basicMap").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ficha.php?id="+this.documentoId,true);
xmlhttp.send();
              
               
                
                 
                  
                   
                     OpenLayers.Event.stop(evt);  });
        
        rutars.addMarker(rutamarker);
        //alert("hoooola");
        
        
        
        
        nodo = new OpenLayers.Geometry.Point(longitudesJsRuta[i], latitudesJsRuta[i]);
        marcadoresLista.push(nodo);
    }
    var linea_style = OpenLayers.Util.extend(
    {},
    OpenLayers.Feature.Vector.style['default']
);
    linea_style.strokeColor = "#BF0101";
    linea_style.strokeWidth = 3;
    var linea = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString(marcadoresLista), null, linea_style);
    var capaVectorial = new OpenLayers.Layer.Vector("Capa Vectorial", {style: linea_style} );
    capaVectorial.addFeatures ([linea]);
    
    
    map.addLayer(capaVectorial);
    map.addLayer(rutars);
        //alert(selectedradiosJs[1]+"selectedRadio");
}
        
        //window.Location("verRuta.php");
        
function verRutaUsuario(){
    rutaUsuario = new OpenLayers.Layer.Markers( "RutaUsuario" );
    rutaUsuario.id = "RutaUsuario";
    
    for(i=0; i< markersdataId.length;i++){
       
       var icon = new OpenLayers.Icon(iconos[1], size, offset);
       rutaUsuario.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(markersdataLong[i],markersdataLat[i]),icon));
       
       nodoRuta = new OpenLayers.Geometry.Point(markersdataLong[i], markersdataLat[i]);
       marcadoresListaRuta.push(nodoRuta);
    }
    
    var lineaRuta = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString(marcadoresListaRuta));
    var capaVectorialRuta = new OpenLayers.Layer.Vector("Capa Vectorial Ruta", {style: point_style});
    capaVectorialRuta.addFeatures ([lineaRuta]);
    
    marcadoresListaRuta = new Array();
    
    map.addLayer(capaVectorialRuta);
    map.addLayer(rutaUsuario);
    }
    
        
      
    