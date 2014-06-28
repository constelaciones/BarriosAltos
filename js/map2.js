var map;
OpenLayers.ProxyHost = "/proxy/?url=";

function init(){
    
    vlayer = new OpenLayers.Layer.Vector( "Editable" );
    
    map = new OpenLayers.Map('basicMap', {
        controls: [
            new OpenLayers.Control.PanZoom(),
            new OpenLayers.Control.EditingToolbar(vlayer)
        ]
    });
    var mapnik         = new OpenLayers.Layer.OSM();
    var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
    var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
    var position       = new OpenLayers.LonLat(-2.9222,43.2523).transform( fromProjection, toProjection);
    var zoom           = 17;
    
    map.addLayers([mapnik, vlayer]);
    map.setCenter(position, zoom );

}