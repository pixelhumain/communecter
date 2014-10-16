<?php 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/vis.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vis.min.js' , CClientScript::POS_END);

$cs->registerCssFile("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
$cs->registerCssFile($this->module->assetsUrl. '/css/leaflet.draw.css');
$cs->registerCssFile($this->module->assetsUrl. '/css/leaflet.draw.ie.css');
$cs->registerCssFile($this->module->assetsUrl. '/css/MarkerCluster.css');
$cs->registerCssFile($this->module->assetsUrl. '/css/MarkerCluster.Default.css');
$cs->registerCssFile($this->module->assetsUrl. '/css/sig.css');
//$cs->registerCssFile($this->module->assetsUrl. '/css/leaflet.awesome-markers.css');

$cs->registerScriptFile('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl.'/js/leaflet.draw-src.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl.'/js/leaflet.draw.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl.'/js/leaflet.markercluster-src.js' , CClientScript::POS_END);
//$cs->registerScriptFile($this->module->assetsUrl.'/js/sigCommunecter.js' , CClientScript::POS_END);
//$cs->registerScriptFile($this->module->assetsUrl.'/js/leaflet.awesome-markers.min.js' , CClientScript::POS_END);

//$this->pageTitle=$this::moduleTitle;
?>

 <!-- 	RIGHT TOOL MAP (PSEUDO SEARCH + LIST ELEMENTS) -->		
	<div id="right_tool_map">
		<!-- 	PSEUDO SEARCH -->	
		<div id="map_pseudo_filters">
			<input type="text" placeholder="recherche par pseudo..." id="input_txt_pseudo_filter"/>
			<a href="#" id="btn_pseudo_filter">
				<center><img src='<?php echo $this->module->assetsUrl; ?>/images/sig/ico_filter_pseudo.png' style='margin-top:3px;' width=22></center>
			</a>
		</div>
		<!-- 	PSEUDO SEARCH -->	
		<!-- 	LIST ELEMENT -->	
		<div id="liste_map_element">
		</div>
	</div>
<!-- 	RIGHT TOOL MAP (PSEUDO SEARCH + LIST ELEMENTS) -->	

<!-- 	LEFT BAR MAP -->
	<div id="left_barre_tool_map">	
		<!-- 	BTN HOME -->
		<a href="javascript:zoomToMyPosition()" id="btn_home" class="btn_right_barre_tool_map" style="padding-top:12px; padding-bottom:8px;">
			<center><img src="<?php echo $this->module->assetsUrl; ?>/images/sig/btn_go_home.png" height=25></center>
		</a>
		<!-- 	BTN ZOOM IN -->
		<a href="javascript:zoomIn()" id="btn_zoom_in" class="btn_right_barre_tool_map" style="font-size:25px;">
			<center>+</center>
		</a>
		<!-- 	BTN ZOOM OUT -->
		<a href="javascript:zoomOut()" id="btn_zoom_out" class="btn_right_barre_tool_map" style="font-size:25px;">
			<center>-</center>
		</a>
		<!-- 	BTN RELOAD MAP -->
		<a href="#" id="btn_reload_map" class="btn_right_barre_tool_map">
			<center><img src="<?php echo $this->module->assetsUrl; ?>/images/sig/reload.png" height=30></center>
		</a>
		
		
	</div>
<!-- 	LEFT BAR MAP -->

<div class="mapCanvas" id="mapCanvas">
</div> 
 