var flag=0;
var positionMarker;
var iconos = new Array();
iconos[0] = "http://www.constelacionesonline.net/barriosaltos/images/Icono_foto.png";
iconos[1] = "http://www.constelacionesonline.net/barriosaltos/images/Icono_video.png";
iconos[2] = "http://www.constelacionesonline.net/barriosaltos/images/Icono_audio.png";
iconos[3] = "http://www.constelacionesonline.net/barriosaltos/images/Icono_documento.png";
//iconos[4] = "iconos_png/";
var icono;
var map;
var popup;
var aqui;
var newmarker;
          
function verTodo(){
    markers = new OpenLayers.Layer.Markers( "Markers" );
    markers.id = "Markers";
    map.addLayer(markers);		
       
    var size = new OpenLayers.Size(20,19); //tamaño del icono!!!
    var offset = new OpenLayers.Pixel(-(size.w), -size.h);
    
    //alert(selectedradiosJs[1]);
    console.log("miau");
    //selectedradiosJs = eval(<?php echo $selectedradiosJson; ?>);
    console.log(markersdata+"a");
    for(i=0; i< markersdata.length;i++){
        //document.write(selectedradiosJs[i]);
        //console.log(markersdata[i].selectedradio);
        switch(markersdata[i].selectedradio){
            case "foto":
                icono = iconos[0];
            break;
            case "video":
                icono = iconos[1];
            break;
            case "audio":
                icono = iconos[2];
            break;
            default :
                icono = iconos[3];
        }                        
        //new OpenLayers.Layer.Markers(idmaterial[i]);
        //var idmaterial[i] = new OpenLayers.Marker(new OpenLayers.LonLat(longitudesJs[i],latitudesJs[i]),icon));
        //markers.addMarker(idmaterial[i]);
        var icon = new OpenLayers.Icon(icono, size, offset);
        var newmarker=new OpenLayers.Marker(new OpenLayers.LonLat(markersdata[i].longitud,markersdata[i].latitud),icon);
        
        newmarker.lonlat=new OpenLayers.LonLat(markersdata[i].longitud,markersdata[i].latitud);
        newmarker.documentoId=markersdata[i].material_id;
        newmarker.nombre = markersdata[i].titulo_registro;
        
        newmarker.events.register('mouseover', newmarker, function(evt) { console.log(this.documentoId); OpenLayers.Event.stop(evt); $("#info_marcador").html(this.nombre); });
        //newmarker.events.register('click', newmarker, markerClick);
        newmarker.events.register('click', newmarker, function(evt) { 
            
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
        
        markers.addMarker(newmarker);
        
        //var sourceMarker=new OpenLayers.Marker(location,icon)
    } 
 
        
               function markerClick(evt) {
        	var position = this.events.getMousePosition(evt);

        	var lonlat = map.getLonLatFromPixel(position); //evt.object.lonlat
        	if(popup == null){
				
        		popup = new OpenLayers.Popup(this.documentoId, this.lonlat,
        			new OpenLayers.Size(250,180),
        			"",
    				true);
        		popup.setBackgroundColor("green");
        		popup.setBorder("1px solid green");
                        map.addPopup(popup);
        		}else{
        		popup.toggle();
        	}
        	OpenLayers.Event.stop(evt);
			
        }       
}

function marcadorDoc(){
    console.log("aqui stoy!");
    //marcadorDoc = new OpenLayers.Layer.Markers( "MarcadorDoc" );
//    marcadorDoc.id = "MarcadorDoc";
//    map.addLayer(marcadorDoc);
    
//    var size = new OpenLayers.Size(20,19); //tamaño del icono!!!
//    var offset = new OpenLayers.Pixel(-(size.w), -size.h);
    
//    for(i=0; i< infoMarcador.length;i++){
//        switch(infoMarcador[i].selectedradio){
//            case "foto":
//                icono = iconos[0];
//            break;
//            case "video":
//                icono = iconos[1];
//            break;
//            case "audio":
//                icono = iconos[2];
//            break;
//            default :
//                icono = iconos[3];
//        }
//        var icon = new OpenLayers.Icon(icono, size, offset);
//        var newmarcadorDoc = new OpenLayers.Marker(new OpenLayers.LonLat(infoMarcador[i].longitud,infoMarcador[i].latitud),icon);
//        newmarcadorDoc.documentoId=infoMarcador[i].material_id;
//        newmarcadorDoc.nombre = infoMarcador[i].titulo_registro;
//        newmarcadorDoc.events.register('mouseover', newmarcadorDoc, function(evt) { console.log(this.documentoId); OpenLayers.Event.stop(evt); $("#info_marcador").html(this.nombre); });
        
//        marcadorDoc.addMarker(newmarcadorDoc);
                
//         }               
                                
}