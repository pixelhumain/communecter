
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
 
 
<script type="text/javascript">

$(document).ready( function() 
{ 	
	var listIdElementMap = new Array();
	
	function loadMap(canvasId, myPosition){

		//initialisation des variables de départ de la carte
		var map = L.map(canvasId, { "zoomControl" : false, 
									"scrollWheelZoom" : false,
									"doubleClickZoom" : true,
									"worldCopyJump" : true }).setView(myPosition, 12);
		//alert(myPosition);
		L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			subdomains: 'abcd',
			minZoom: 2,
			maxZoom: 14
		}).setOpacity(0.4).addTo(map);
	
		return map; 
	}								

	
	//##
	//affiche les citoyens qui possèdent des attributs geo.latitude, geo.longitude, depuis la BD
	function showCitoyensClusters(mapClusters, origine, listIdElementMap){ 
		
		//gère la liste des tags à ne pas clusteriser
		var notClusteredTag = new Array("commune", "association", "projectLeader");
		
		var markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
		mapClusters.addLayer(markersLayer);

		var geoJsonCollection = { type: 'FeatureCollection', features: new Array() };
				
		var bounds = mapClusters.getBounds();
		var params = {};
		params["latMinScope"] = bounds.getSouthWest().lat;
		params["lngMinScope"] = bounds.getSouthWest().lng;
		params["latMaxScope"] = bounds.getNorthEast().lat;
		params["lngMaxScope"] = bounds.getNorthEast().lng;
		
		//$('#gif_loading_map').css({'visibility' : 'visible'});
		$('#btn_reload_map').html('<center><img src="<?php echo $this->module->assetsUrl; ?>/images/ajax-loader.gif" height=22></center>');
		
		testitpost("", '/ph/communecter/sig/' + origine, params,
			function (data){ //alert(JSON.stringify(data));
			
				var length = 0;
				$.each(data, function() { 	length++; });
				$('#gif_loading_map').append((length-1) + " éléments reçus ");
		
				var origineName = data["origine"]; //alert(origineName);
					$.each(data, function() { 			
					if(this._id != null){
				
						var objectId = this._id.$id.toString();
								
						if($.inArray(objectId, listIdElementMap[origineName]) == -1){							 	
							if(this['geo'] != null || this['geoPosition'] != null){
								
								//préparation du contenu de la bulle
								var content = getPopupCitoyen(this);
								
								//création de l'icon sur la carte
								var theIcon = getIcoMarker(this['tag']);
								var properties = { 	icon : theIcon,
													content: content };
								
								//récupération des coordonnées
								var coordinates;
								if( this['geo']['longitude'] != null ){
									coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
								}
								else{
									coordinates = this['geoPosition']['coordinates'];
								}
						
								var tag = this['tag'];
								if(this['tag'] == null) tag = "citoyen";
								//gère l'affichage de certains éléments hors des clusters
								if($.inArray(tag, notClusteredTag) > -1){ //si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
									getMarkerSingle(mapClusters, properties, coordinates);
									listIdElementMap[origineName].push(objectId);
								} 
								else{
									var marker = getGeoJsonMarker(properties, coordinates);
									geoJsonCollection['features'].push(marker);	
									listIdElementMap[origineName].push(objectId);
								} 
						
							}
						}
					}
				});
				
				var points = L.geoJson(geoJsonCollection, {					   //Pour les clusters seulement :
					onEachFeature: function (feature, layer) {				   //sur chaque marker
							layer.bindPopup(feature["properties"]["content"]); //ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   //affiche l'icon demandé
							layer.on('mouseover', function(e) {	if(!layer.getPopup()._isOpen) layer.openPopup(); });
							layer.on('mouseout',  function(e) { layer.closePopup(); });
						}
					});
									
				markersLayer.addLayer(points); 			// add it to the cluster group
				mapClusters.addLayer(markersLayer);		// add it to the map
				
				//$('#gif_loading_map').css({'visibility' : 'hidden'});
				//$('#gif_loading_map').css({'visibility' : 'hidden'});
				$('#btn_reload_map').html('<center><img src="<?php echo $this->module->assetsUrl; ?>/images/sig/reload.png" height=30></center>');
		
			});
						
	}
	
	function getPopupCitoyen(citoyen){
		//THUMB PHOTO PROFIL
		var content = "";
		if(citoyen['thumb_path'] != null)   
		content += 	"<img src='" + citoyen['thumb_path'] + "' height=70 class='popup-info-profil-thumb'>";

		//NOM DE L'UTILISATEUR
		if(citoyen['name'] != null)   
		content += 	"<div class='popup-info-profil-username'>" + citoyen['name'] + "</div>";

		//TYPE D'UTILISATEUR (CITOYEN, ASSO, PARTENAIRE, ETC)
		var typeName = citoyen['type'];
		if(citoyen['type'] == null)  typeName = "Citoyen";
		if(citoyen['name'] == null)  typeName += " anonyme";

		content += 	"<div class='popup-info-profil-usertype'>" + typeName + "</div>";

		//WORK - PROFESSION
		if(citoyen['work'] != null)     
		content += 	"<div class='popup-info-profil-work'>" + citoyen['work'] + "</div>";

		//URL
		if(citoyen['url'] != null)     
		content += 	"<div class='popup-info-profil-url'>" + citoyen['url'] + "</div>";

		//CODE POSTAL
		if(citoyen['cp'] != null)     
		content += 	"<div class='popup-info-profil'>" + citoyen['cp'] + "</div>";

		//VILLE ET PAYS
		var place = citoyen['city'];
		if(citoyen['city'] != null && citoyen['country'] != null) place += ", ";
		place += citoyen['country'];

		if(citoyen['city'] != null)     
		content += 	"<div class='popup-info-profil'>" + place + "</div>";

		//NUMÉRO DE TEL
		if(citoyen['phoneNumber'] != null)     
		content += 	"<div class='popup-info-profil'>" + citoyen['phoneNumber'] + "<div/>";
		
		return content;
	}				
					
	//##
	//créé une donnée marker geoJson
	function getGeoJsonMarker(properties/*json*/, coordinates/*array[lat, lng]*/) {
		return { "type": 'Feature',
				 "properties": properties,
				 "geometry": { type: 'Point',
							 coordinates: coordinates } };
	}

	//##
	//créer un marker sur la carte, en fonction de sa position géographique
	function getMarkerSingle(thisMap, options, coordinates){ //ex : lat = -34.397; lng = 150.644;

		var contentString = options.content;
		if(options.content == null) contentString = "info window"; 

		var markerOptions = { icon : options.icon };

		var marker = L.marker(new Array(coordinates[1], coordinates[0]), markerOptions).addTo(thisMap)
		.bindPopup(contentString);
		
		marker.on('mouseover', function(e) { marker.openPopup(); });
		marker.on('mouseout',  function(e) { marker.closePopup(); });
		
		return marker;
	}
		
	//##
	//récupère le nom de l'icon en fonction du type de marker souhaité
	function getIcoMarker(tag){
		
		if(tag == null) tag = "citoyen";
						
  		if(tag == "citoyen") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_CITOYENS.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7, 7],
												popupAnchor: 	[0, -14] });
													
		if(tag == "pixelActif") 		return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_PIXEL_ACTIF.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });	
																								
		if(tag == "partnerPH") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_PARTENAIRES.png'; ?>",
												iconSize: 		[14, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -14] });		
													
		if(tag == "commune") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_COMMUNES.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });		
		
		if(tag == "association") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_ASSOCIATIONS.png'; ?>",
												iconSize: 		[15, 13],
												iconAnchor: 	[7,  13],
												popupAnchor: 	[0, -13] });		
		
		if(tag == "projectLeader") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_PORTEUR_PROJET.png'; ?>",
												iconSize: 		[15, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -16] });		
		
		if(tag == "artiste") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_ARTISTES.png'; ?>",
												iconSize: 		[17, 19],
												iconAnchor: 	[8,  19],
												popupAnchor: 	[0, -19] });		
		
		if(tag == "home") 		return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/HOME.png'; ?>",
												iconSize: 		[32, 32],
												iconAnchor: 	[16,  32],
												popupAnchor: 	[0, -32] });			  		
		
		return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/btn_zoom_my_home.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });			  						
	}
	
	function showMyPosition(map, origine, myInfos){
		var content = getPopupCitoyen(myInfos);
								
		//création de l'icon sur la carte
		var theIcon = getIcoMarker("home");
		var properties = { 	icon : theIcon,
							content: content };
		
		//récupération des coordonnées
		var coordinates;
		if( myInfos['geo']['longitude'] != null ){
			coordinates = new Array (myInfos['geo']['longitude'], myInfos['geo']['latitude']);
		}
		else{
			coordinates = myInfos['geoPosition']['coordinates'];
		}

		getMarkerSingle(map, properties, coordinates);
		var objectId = myInfos._id.$id.toString();
		listIdElementMap[origine].push(objectId);
	}
	
	function initMap(origine, myInfos, myPosition){	
		
		var initCenter = (myPosition != null) ? myPosition : [30.29702, -21.97266];
		
		//charge la carte
		map = loadMap("mapCanvas", initCenter);
		
		listIdElementMap[origine] = new Array(); //getNetworkMapElement
		showMyPosition(map, origine, myInfos);
		// map.on('dragend', function(e) {
		//	showCitoyensClusters(map, origine, listIdElementMap);
		// }); 
		showCitoyensClusters(map, origine, listIdElementMap);
		
		$('#btn_reload_map').click(function(event) {
			showCitoyensClusters(map, origine, listIdElementMap);
		});
		
		
	}
	
	testitpost("", '/ph/communecter/sig/GetMyPosition', null,
		function (data){ //alert(JSON.stringify(data));
			var myInfos;
			$.each(data, function() { 
				myInfos = this;
				myPosition = new Array( this.geo.latitude, this.geo.longitude );
			});
		initMap("ShowMyNetwork", myInfos, myPosition);
	});	
	
});

	var map, myPosition;
	function zoomIn(){ map.zoomIn(); }
	function zoomOut(){ map.zoomOut(); }
	function zoomToMyPosition(){ map.panTo(myPosition); map.setZoom(12); }
	
	
</script>

<div style="margin:5px; padding:5px; background-color:white; visibility:hidden;" id="gif_loading_map">
	<h4><img src="<?php echo $this->module->assetsUrl; ?>/images/ajax-loader.gif">
		<div id="msg_loading_map"></div>
	</h4>
</div>


