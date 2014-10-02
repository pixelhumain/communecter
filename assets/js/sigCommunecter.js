var listIdElementMap = new Array();
	
	function loadMap(canvasId, myPosition){

		//initialisation des variables de départ de la carte
		var map = L.map(canvasId).setView(myPosition, 12);
		//alert(myPosition);
		L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			subdomains: 'abcd',
			minZoom: 2,
			maxZoom: 14
		}).setOpacity(0.4).addTo(map);
	
		map.on('click', function(e) {
    		alert(map.getZoom()); 
    		//alert(e.latlng);
		});
	
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
		
		$('#gif_loading_map').css({'visibility' : 'visible'});
		
		testitpost("", '/ph/communecter/sig/' + origine, params,
			function (data){ //alert(JSON.stringify(data));
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
				
				$('#gif_loading_map').css({'visibility' : 'hidden'});
		
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
			alert("tag : ");
		if(tag == null) tag = "citoyen";
					
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
	
	function initMap(origine, myPosition){	
		
		var initCenter = myPosition;
		if(initCenter == null) initCenter = [30.29702, -21.97266];
		
		//charge la carte
		var map = loadMap("mapCanvas", initCenter);
		//map.panTo(initCenter);
		//map.setView(initCenter, 3);

		listIdElementMap[origine] = new Array(); //getNetworkMapElement
		map.on('dragend', function(e) {
				showCitoyensClusters(map, origine, listIdElementMap);
			}); showCitoyensClusters(map, origine, listIdElementMap);
		
		
	}
	
	