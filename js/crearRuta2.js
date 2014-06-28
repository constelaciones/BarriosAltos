          //var flag=0;
	  var positionMarker;
          var longitud = new Array(); // array de lat/lon
          var latitud = new Array();
          var map, layer, markerslayer;
          
      function init() {
        var mapnik = new OpenLayers.Layer.OSM();
        vlayer = new OpenLayers.Layer.Vector( "Draws" );
        map = new OpenLayers.Map('basicMap', {
             controls: [
                        new OpenLayers.Control.PanZoom(),
                        new OpenLayers.Control.EditingToolbar(vlayer)
                    ]
                });
                
        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
        var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
        var zoom           = 17;
        var position       = new OpenLayers.LonLat(-2.9222,43.2523).transform(fromProjection, toProjection);
        
        map.addControl(new OpenLayers.Control.LayerSwitcher());

            

        map.addLayers([mapnik, vlayer]);
        map.setCenter(position, zoom );
        		
        markers = new OpenLayers.Layer.Markers( "Markers" );
        markers.id = "Markers";
        map.addLayer(markers);
			
        map.events.register("click", map, function(e) {
                //if(flag==0){
                        positionMarker = map.getLonLatFromPixel(e.xy);
                        //alert("Lon: "+positionMarker.lon+", Lat:"+positionMarker.lat);
                        var size = new OpenLayers.Size(21,25);
                        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
                        var icon = new OpenLayers.Icon('../constelaciones/images/marker.png', size, offset);
                        var markerslayer = map.getLayer('Markers');
                        markerslayer.addMarker(new OpenLayers.Marker(positionMarker,icon));
                        
                        //flag=1;

                        longitud.push(positionMarker.lon);
                        latitud.push(positionMarker.lat);
                        //if(longitud.length > 1){

                        document.añadirNuevo.longitud.value=longitud.toString();
                        document.añadirNuevo.latitud.value=latitud.toString();
                        //}
                        
            });
            
          for(i=0; i< longitudesJs.length;i++){
               markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(longitudesJs[i],latitudesJs[i]),icon));  
               }
      }
      
      
    function modificarGeoposicion() {
        //alert(longitud +" "+ latitud);
        
        //document.forms["formulario"].elements["longitud"].value = positionMarker.lon;
        //document.forms["formulario"].elements["latitud"].value = positionMarker.lat;
    }