        var map, wms;
        OpenLayers.ProxyHost = "/proxy/?url=";
        
        function init(){
            vlayer = new OpenLayers.Layer.Vector( "Editable" );
            map = new OpenLayers.Map('basicMap', {
                controls: [
                    new OpenLayers.Control.PanZoomBar(),
                    new OpenLayers.Control.ScaleLine(),
                    new OpenLayers.Control.OverviewMap(),
                    new OpenLayers.Control.EditingToolbar(vlayer)
                ]
            });
            var mapnik         = new OpenLayers.Layer.OSM();
            var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
            var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
            var position       = new OpenLayers.LonLat(-2.928031,43.255612).transform( fromProjection, toProjection);
            var zoom           = 16;
            //var panZoomBar = new OpenLayers.Control.PanZoomBar({'position': new OpenLayers.Pixel(4,65)});
            var scaleline = new OpenLayers.Control.ScaleLine();
           
            new OpenLayers.Control.EditingToolbar(vlayer);
            var LayerSwitcher = new OpenLayers.Control.LayerSwitcher({minimize:false});
            var OverviewMap = new OpenLayers.Control.OverviewMap({minimize:false});
 
           //Engadir capa Bing
    var map2 = new OpenLayers.Map("ch2_bing");
    var bingApiKey = "AtEVHzQFLQvFz8oPcK0Q7qR9wJ7CalaJjE0SiVL28dWv7msr593YL82O6KbwnoDj";
    var road = new OpenLayers.Layer.Bing({
        name: "Road",
        type: "Road",
        key: bingApiKey
    });
    var hybrid = new OpenLayers.Layer.Bing({
        name: "Hybrid",        
        type: "AerialWithLabels",
        key: bingApiKey
    });
    var aerial = new OpenLayers.Layer.Bing({
        name: "Aerial",
        type: "Aerial",
        key: bingApiKey
    });
  
            map.addLayer(mapnik, vlayer);
           
            map.setCenter(position, zoom );
            map.addLayers([road, hybrid, aerial]);
            map.addLayers([mapnik, vlayer]);
            //Engadir LayerSwitcher control
            map.addControl(LayerSwitcher);
            LayerSwitcher.maximizeControl();

            //map.addControl(panZoomBar);
            map.addControl(scaleLine);
 
            map.addControl(OverviewMap);
           OverviewMap.maximizeControl();
           
        }   




	