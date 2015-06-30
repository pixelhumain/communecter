<?php
/*		$cs = Yii::app()->getClientScript();

		//$cs->registerCssFile("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.draw.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.draw.ie.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/MarkerCluster.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/MarkerCluster.Default.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.awesome-markers.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/sig.css');
		//$cs->registerCssFile($this->module->assetsUrl. '/css/sig/sig_network_mapping.css');

		//$cs->registerScriptFile('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.draw-src.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.draw.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.markercluster-src.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.awesome-markers.min.js' , CClientScript::POS_END);


		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map_initializer.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map_panel.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map_popupContent.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map_rightList.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map_findPlace.js' , CClientScript::POS_END);
*/
		$cssAndScriptFiles = array(

			//css
			'/css/sig/leaflet/leaflet.css',
			'/css/sig/leaflet/leaflet.draw.css',
			'/css/sig/leaflet/leaflet.draw.ie.css',
			'/css/sig/leaflet/MarkerCluster.css',
			'/css/sig/leaflet/MarkerCluster.Default.css',
			'/css/sig/leaflet/leaflet.awesome-markers.css',
			'/css/sig/leaflet/sig.css',

			//js
			'/js/sig/leaflet/leaflet.js',
			'/js/sig/leaflet/leaflet.draw-src.js',
			'/js/sig/leaflet/leaflet.draw.js',
			'/js/sig/leaflet/leaflet.markercluster-src.js',
			'/js/sig/leaflet/leaflet.awesome-markers.js',

			'/js/sig/leaflet/map.js',
			'/js/sig/leaflet/map_initializer.js',
			'/js/sig/leaflet/map_panel.js',
			'/js/sig/leaflet/map_popupContent.js',
			'/js/sig/leaflet/map_rightList.js',
			'/js/sig/leaflet/map_findPlace.js',


		);
		//echo $this->module->assetsUrl; die();
		HtmlHelper::registerCssAndScriptsFiles( $cssAndScriptFiles , $this->module->assetsUrl."");

?>
