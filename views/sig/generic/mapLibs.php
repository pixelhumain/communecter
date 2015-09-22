<?php
		$cssAnsScriptFilesModule = array(
		
		'/css/sig/leaflet/leaflet.css',
		'/css/sig/leaflet/leaflet.draw.css',
		'/css/sig/leaflet/leaflet.draw.ie.css',
		'/css/sig/leaflet/MarkerCluster.css',
		'/css/sig/leaflet/MarkerCluster.Default.css',
		'/css/sig/leaflet/leaflet.awesome-markers.css',
		'/css/sig/sig.css',

		'/js/sig/leaflet/leaflet.js',
		'/js/sig/leaflet/leaflet.draw-src.js',
		'/js/sig/leaflet/leaflet.draw.js',
		'/js/sig/leaflet/leaflet.markercluster-src.js',
		'/js/sig/leaflet/leaflet.awesome-markers.min.js',

		'/js/sig/map.js' , 
		'/js/sig/map_initializer.js' ,
		'/js/sig/map_panel.js' ,
		'/js/sig/map_popupContent.js' ,
		'/js/sig/map_rightList.js' ,
		'/js/sig/map_findPlace.js' ,
		'/js/sig/map_findPlace.js' ,
		'/js/sig/map_charts.js',
		);
	
		HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>
