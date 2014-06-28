var flag=0;
var positionMarker;
//iconos[4] = "iconos_png/";
var icono;
var map;
          
function verAgentes(){
    markersAgentes = new OpenLayers.Layer.Markers( "MarkersAgentes" );
    markersAgentes.id = "MarkersAgentes";
    map.addLayer(markersAgentes);		
       
    var size = new OpenLayers.Size(20,19); //tamaño del icono!!!
    var offset = new OpenLayers.Pixel(-(size.w), -size.h);
    
    //alert(selectedradiosJs[1]);
    console.log("miau");
    //console.log(markersdataAgentes+"a");
    //selectedradiosJs = eval(<?php echo $selectedradiosJson; ?>);
    //console.log(selectedradiosJs[1]);
    for(i=0; i< markersdataAgente.length;i++){
        //document.write(selectedradiosJs[i]);
        //console.log(markersdata[i].selectedradio);
        //new OpenLayers.Layer.Markers(idmaterial[i]);
        //var idmaterial[i] = new OpenLayers.Marker(new OpenLayers.LonLat(longitudesJs[i],latitudesJs[i]),icon));
        //markers.addMarker(idmaterial[i]);
        var icon = new OpenLayers.Icon('http://www.constelacionesonline.net/barriosaltos/images/Icono_info_30x30.png', size, offset);
        var newmarker=new OpenLayers.Marker(new OpenLayers.LonLat(markersdataAgente[i].longitud,markersdataAgente[i].latitud),icon);
        newmarker.AgenteId=markersdataAgente[i].agente_id;
        newmarker.nombre = markersdata[i].nombre;
        newmarker.events.register('mouseover', newmarker, function(evt) { console.log(this.AgenteId); OpenLayers.Event.stop(evt); $("#info_marcador").html(this.nombre); });
        newmarker.events.register('click', newmarker, function(evt) { 
            
             if (this.AgenteId=="")
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
xmlhttp.open("GET","fichaAgente.php?id="+this.AgenteId,true);
xmlhttp.send();
              
               
                
                 
                  
                   
                     OpenLayers.Event.stop(evt);  });
        
        markersAgentes.addMarker(newmarker);
        
        //var sourceMarker=new OpenLayers.Marker(location,icon)
    } 
        
}
