
<style type="text/css">
 .mapCanvas{
 	min-width:100%;
 	min-height:300px;
 	background-color:#425766;
 	color:black;
 }
 
 #project .slide-content .mapCanvasSlider img{
 	border-radius:0px;
 	box-shadow: 0px 0px 0px 0px;
 }
 
 #project{
 	color:black;
 }
 
 .leaflet-popup-content-wrapper{
 	background-color:rgba(53, 61, 68, 0.7);
 	border-radius:10px;
 	color:white;
 	font-family: "Open Sans";
 }
 
 .leaflet-popup-tip{
 	background-color:rgba(53, 61, 68, 0.7);
 }
 
 .popup-img-profil{
 
 }

 .popup-info-profil{
 	width:100%;
 	text-align:center;
 	font-size:14px;
 }
 .popup-info-profil-username{
 	width:100%;
 	text-transform:capitalize;
 	text-align:center;
 	font-size:30px;
 	color:yellow;
 }
 .popup-info-profil-usertype{
 	width:100%;
 	text-transform:capitalize;
 	text-align:center;
 	font-size:18px;
 }
 .popup-info-profil-work{
 	width:100%;
 	text-align:center;
 	font-size:18px;
 	text-transform:capitalize;
 	
 }
 .popup-info-profil-url{
 	width:100%;
 	text-align:center;
 	font-size:13px;
 	color:#2aa0bd;
 }

</style>
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
//$cs->registerScriptFile($this->module->assetsUrl.'/js/leaflet.awesome-markers.min.js' , CClientScript::POS_END);

//$this->pageTitle=$this::moduleTitle;


?>

<div class="mapCanvas" id="mapCanvas">
</div> 
 
 
<script type="text/javascript">

$(document).ready( function() 
{ 
	var listId = new Array();
	
	function loadMap(canvasId){
		//initialisation des variables de départ de la carte
		var map = L.map(canvasId).setView([51.505, -0.09], 4);

		L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			subdomains: 'abcd',
			minZoom: 0,
			maxZoom: 20
		}).setOpacity(0.4).addTo(map);
	
		map.on('click', function(e) {
    		alert(e.latlng);
		});
	
		return map;
	}								
															
				
	//##
	//affiche les citoyens qui possèdent des attributs geo.latitude, geo.longitude, depuis la BD
	function showCitoyensClusters(mapClusters, origine, listId){ 
		
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
		
		testitpost("", '/ph/sig/api/' + origine, params,
			function (data){ 		//alert(JSON.stringify(data));
				$.each(data, function() { 			
					if(this._id != null){
				
						var origineName = data["origine"]; //alert(origineName);
						var objectId = this._id.$id.toString();
				
						if($.inArray(objectId, listId[origineName]) == -1){							 	
							if(this['geo'] != null || this['geoPosition'] != null){
										
								//préparation du contenu de la bulle
						
								//THUMB PHOTO PROFIL
								var content = "";
								if(this['thumb_path'] != null)   
								content += 	"<img src='" + this['thumb_path'] + "' height=70 class='popup-info-profil-thumb'>";
						
								//NOM DE L'UTILISATEUR
								if(this['name'] != null)   
								content += 	"<div class='popup-info-profil-username'>" + this['name'] + "</div>";
						
								//TYPE D'UTILISATEUR (CITOYEN, ASSO, PARTENAIRE, ETC)
								var typeName = this['type'];
								if(this['type'] == null)  typeName = "Citoyen";
								if(this['name'] == null)  typeName += " anonyme";
						
								content += 	"<div class='popup-info-profil-usertype'>" + typeName + "</div>";
						
								//WORK - PROFESSION
								if(this['work'] != null)     
								content += 	"<div class='popup-info-profil-work'>" + this['work'] + "</div>";
						
								//URL
								if(this['url'] != null)     
								content += 	"<div class='popup-info-profil-url'>" + this['url'] + "</div>";
						
								//CODE POSTAL
								if(this['cp'] != null)     
								content += 	"<div class='popup-info-profil'>" + this['cp'] + "</div>";
						
								//VILLE ET PAYS
								var place = this['city'];
								if(this['city'] != null && this['country'] != null) place += ", ";
								place += this['country'];
						
								if(this['city'] != null)     
								content += 	"<div class='popup-info-profil'>" + place + "</div>";
						
								//NUMÉRO DE TEL
								if(this['phoneNumber'] != null)     
								content += 	"<div class='popup-info-profil'>" + this['phoneNumber'] + "<div/>";
						
						
								//création de l'icon sur la carte
								var tag;
								if(this['tag'] != null) tag = this['tag'];
								else tag = "citoyen";
						
								var theIcon = getIcoMarker(tag);
								var properties = { 	//title : this['name'], 
													icon : theIcon,
													content: content };
						
								var coordinates;
								if( this['geo']['longitude'] != null ){
									coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
								}
								else{
									coordinates = this['geoPosition']['coordinates'];
								}
						
								var marker;
								if($.inArray(tag, notClusteredTag) > -1){ //si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
									getMarkerSingle(mapClusters, properties, coordinates);
							
									listId[origineName].push(objectId);
							
									//alert(" single - tag : " + tag);
									//alert(notClusteredTag);
								} 
								else{
									marker = getGeoJsonMarker(properties, coordinates);
									geoJsonCollection['features'].push(marker);	
							
									listId[origineName].push(objectId);
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
			});
						
	}
					
					
	//##
	//créé une donnée geoJson
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

		var marker = L.marker(coordinates, markerOptions).addTo(thisMap)
		.bindPopup(contentString);
		
		marker.on('mouseover', function(e) { marker.openPopup(); });
		marker.on('mouseout',  function(e) { marker.closePopup(); });
		
		return marker;
	}
		
	//##
	//récupère le nom de l'icon en fonction du type de marker souhaité
	function getIcoMarker(tag){
			
  		if(tag == "citoyen") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_CITOYENS.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7, 7],
												popupAnchor: 	[0, -14] });
													
		if(tag == "pixelActif") 		return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_PIXEL_ACTIF.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });	
																								
		if(tag == "partnerPH") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_PARTENAIRES.png'; ?>",
												iconSize: 		[14, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -14] });		
													
		if(tag == "commune") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_COMMUNES.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });		
		
		if(tag == "association") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_ASSOCIATIONS.png'; ?>",
												iconSize: 		[15, 13],
												iconAnchor: 	[7,  13],
												popupAnchor: 	[0, -13] });		
		
		if(tag == "projectLeader") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_PORTEUR_PROJET.png'; ?>",
												iconSize: 		[15, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -16] });		
		
		if(tag == "artiste") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_ARTISTES.png'; ?>",
												iconSize: 		[17, 19],
												iconAnchor: 	[8,  19],
												popupAnchor: 	[0, -19] });		
		
		return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_CITOYENS.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });			  						
	}
	
		
	//charge la première carte (pixel actif)
	var map = loadMap("mapCanvas");
	map.setView([30.29702, -21.97266], 3);
	listId["getCommunected"] = new Array(); //getNetworkMapElement
	map.on('dragend', function(e) {
    		//showCitoyensClusters(map, "getNetworkMapElement", listId);
		}); showCitoyensClusters(map, "getCommunected", listId);
		
	//Yii::app()->session["userId"] PHP

});
</script>

<h1>La Super carte de Tristango !!</h1>