
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
			<a href="" id="btn_pseudo_filter">
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
 

 
<script type="text/javascript">

$(document).ready( function() 
{ 	
	
	function loadMap(canvasId, myPosition){

		//initialisation des variables de départ de la carte
		var map = L.map(canvasId, { "zoomControl" : false, 
									"scrollWheelZoom" : false,
									"doubleClickZoom" : true,
									"worldCopyJump" : true }).setView(myPosition, 3);//12);
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
		
		$('#btn_reload_map').html('<center><img src="<?php echo $this->module->assetsUrl; ?>/images/ajax-loader.gif" height=22></center>');
		testitpost("", '/ph/communecter/sig/' + origine, params,
			function (data){ //alert(JSON.stringify(data));
			
				var length = 0;
				$.each(data, function() { 	length++; });
				
				var listItemMap = "";			
				var origineName = data["origine"];
				
				//rend invisible tous les éléments de la liste de droite (pour afficher ensuite seulement les éléments qui sont dans le bound)
				$.each(listIdElementMap[origineName], function() {  //alert(this[0]);	
					$("#item_map_list_" + this[0]).css({ "display" : "none" });				
				});
					
				$.each(data, function() { 	
					if(this._id != null){
						
						//crée la liste à afficher à droite de la carte
						listItemMap += getItemRigthListMap(this, origineName);	
											
						var objectId = this._id.$id.toString();
								
						if($.inArray(objectId, listIdElementMap[origineName]) == -1){							 	
							if(this['geo'] != null || this['geoPosition'] != null){
								
								//préparation du contenu de la bulle
								var content = getPopupCitoyen(this);
								
								//création de l'icon sur la carte
								var theIcon = L.icon(getIcoMarker(this['tag']));
								var properties = { 	_id : objectId,
													icon : theIcon,
													content: content };
													
								
								//récupération des coordonnées
								var coordinates;
								if( this['geo']['longitude'] != null ){
									coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
								}
								else{
									coordinates = this['geoPosition']['coordinates'];
								}
						
								//affiche la liste d'éléments
								$("#liste_map_element").append(getItemRigthListMap(this, origineName));
				
								var tag = this['tag'];
								if(this['tag'] == null) tag = "citoyen";
								//gère l'affichage de certains éléments hors des clusters
								if($.inArray(tag, notClusteredTag) > -1){ //si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
									
									var marker = getMarkerSingle(mapClusters, properties, coordinates);
									listIdElementMap[origineName].push(objectId);
									listPosElementMap[origineName].push({ "_id" : objectId, "coordinates" : coordinates });
									
									//evénement au click sur une éléments de la liste (de droite)
									$('#item_map_list_'+ objectId).on('click',  
									function(e) { marker.openPopup();  map.panTo(marker.getLatLng()); });
								} 
								else {
									var marker = getGeoJsonMarker(properties, coordinates);
									geoJsonCollection['features'].push(marker);	
									//mémorise l'id de l'élément
									listIdElementMap[origineName].push(objectId);
									//mémorise les coordonnées de l'élément
									listPosElementMap[origineName].push({ "_id" : objectId, "coordinates" : coordinates });
								} 
							 }
						   } else // si l'élément a déjà été affiché
						   {	  // on le rend à nouveau visible (sans recharger le marker)
						   		$("#item_map_list_" + objectId).css({"display" : "inline" });	
							}
					      }
					});
								
				var points = L.geoJson(geoJsonCollection, {					   //Pour les clusters seulement :
					onEachFeature: function (feature, layer) {				   //sur chaque marker
							layer.bindPopup(feature["properties"]["content"]); //ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   //affiche l'icon demandé
							layer.on('mouseover', function(e) { layer.openPopup(); });
							layer.on('mouseout',  function(e) { layer.closePopup(); });
							
							//evénement au click sur une éléments de la liste (de droite)
							$('#item_map_list_'+ feature["properties"]["_id"]).on('click',  
							function(e) { layer.openPopup(); map.panTo(layer.getLatLng()); });
						}
					});
									
				markersLayer.addLayer(points); 			// add it to the cluster group
				mapClusters.addLayer(markersLayer);		// add it to the map
				
				$('#btn_reload_map').html('<center><img src="<?php echo $this->module->assetsUrl; ?>/images/sig/reload.png" height=30></center>');
		
			});
						
	}
	
	function getItemRigthListMap(element, origine){
		
		var place = "";
		if(element['city'] != null) place += element['city'];
		if(element['city'] != null && element['cp'] != null) place += ", ";	
		if(element['cp'] != null) place += element['cp'];
		
		var iconUrl = getIcoMarker(element['tag']).iconUrl;
		var item = '<a id="item_map_list_'+ element._id.$id.toString() +'" href="#" class="item_map_list">' 
						+  '<img class="ico_item_map_list" src="' + iconUrl + '" height=14>'
						+  '<div class="pseudo_item_map_list">' +	element['name'] + "</div>"	
						+  '<div class="city_item_map_list">' +	place + "</div>"	
					+  '</a>';	
					
		return item;
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
						
  		if(tag == "citoyen") 	return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_CITOYENS.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7, 7],
												popupAnchor: 	[0, -14] };
													
		if(tag == "pixelActif") return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_PIXEL_ACTIF.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] };	
																								
		if(tag == "partnerPH") 	return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_PARTENAIRES.png'; ?>",
												iconSize: 		[14, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -14] };		
													
		if(tag == "commune") 	return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_COMMUNES.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] };		
		
		if(tag == "association") 	return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_ASSOCIATIONS.png'; ?>",
												iconSize: 		[15, 13],
												iconAnchor: 	[7,  13],
												popupAnchor: 	[0, -13] };		
		
		if(tag == "projectLeader") 	return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_PORTEUR_PROJET.png'; ?>",
												iconSize: 		[15, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -16] };		
		
		if(tag == "artiste") 	return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/02_ICON_ARTISTES.png'; ?>",
												iconSize: 		[17, 19],
												iconAnchor: 	[8,  19],
												popupAnchor: 	[0, -19] };		
		
		if(tag == "home") 		return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/HOME.png'; ?>",
												iconSize: 		[32, 32],
												iconAnchor: 	[16,  32],
												popupAnchor: 	[0, -32] };			  		
		
		return { iconUrl: "<?php echo $this->module->assetsUrl.'/images/sig/markers/btn_zoom_my_home.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] };			  						
	}
	
	function checkListElementMap(origine){ 
	
		//rend invisible tous les éléments de la liste (mais ne les supprime pas
		$.each(listIdElementMap[origine], function() { 
			$("#item_map_list_" + this).css({ "display" : "none" });				
		});
	
		//rend visible tous les éléments qui se trouve dans le bound visible de la carte
		$.each(listPosElementMap[origine], 
			function() { 	
				var bounds = map.getBounds();
		
				if( this.coordinates[0] > bounds.getSouthWest().lng && this.coordinates[0] < bounds.getNorthEast().lng && 
					this.coordinates[1] > bounds.getSouthWest().lat && this.coordinates[1] < bounds.getNorthEast().lat)
					$("#item_map_list_" + this._id).css({"display" : "inline" });	
					 
			});
				
	}
	
	function showMyPosition(map, origine, myInfos){
		var content = getPopupCitoyen(myInfos);
								
		//création de l'icon sur la carte
		var theIcon = L.icon(getIcoMarker("home"));
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
		myPosition = null;
		var initCenter = (myPosition != null) ? myPosition : [30.29702, -21.97266];
		
		//charge la carte
		map = loadMap("mapCanvas", initCenter);
		
		listIdElementMap[origine] = new Array(); 
		listPosElementMap[origine] = new Array(); 
		
		showMyPosition(map, origine, myInfos);
		 map.on('dragend', function(e) {
			checkListElementMap(origine);
		 }); 
		showCitoyensClusters(map, origine, listIdElementMap);
		
		$('#btn_reload_map').click(function(event) {
			showCitoyensClusters(map, origine, listIdElementMap);
		});
	}
	
	function findPlace(){
	var address = "Paris France";
	//var url = "search?q=135+pilkington+avenue,+birmingham&format=json&polygon=1&addressdetails=1";
	$.ajax({
		url: "http://nominatim.openstreetmap.org/search?q=" + address + "&format=json&polygon=0&addressdetails=1",
		type: 'POST',
		//data: { 'htmlViewType': htmlViewType },
		complete: function () { },
		success: function (obj) {//alert(JSON.stringify(obj));
		if (obj.length > 0) {
			//document.getElementById('LblError').innerHTML = obj[0].display_name;
			alert(obj[0].address.city + " - " + obj[0].lat);
			//var markerslonLat = new OpenLayers.LonLat(obj[0].lon, obj[0].lat).transform(WGS84, map.getProjectionObject(), 0);
			//map.setCenter(markerslonLat, 10);
			//var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png', size, offset);
			//var icon = new OpenLayers.Icon(' http://maps.google.com/mapfiles/ms/micons/blue.png', size, offset);
			//markers.addMarker(new OpenLayers.Marker(markerslonLat, icon));
			//map.addLayer(markers);
		}
		else {
			alert('no such address.');
		}
		},
		error: function (error) {
		alert(error);
		}
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
		//findPlace();
	});	
	
});

	var map, myPosition;
	var listIdElementMap = new Array();
	var listPosElementMap = new Array();
	function zoomIn(){ map.zoomIn(); }
	function zoomOut(){ map.zoomOut(); }
	function zoomToMyPosition(){ map.panTo(myPosition); map.setZoom(12); }
	
	
	
</script>
