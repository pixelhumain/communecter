/**
	***		FONCTION PRINCIPALE
	***/				
	function showCitoyensClusters(mapClusters, origine, listIdElementMap){ 
		
		//gère la liste des tags à ne pas clusteriser
		var notClusteredTag = new Array("commune", "association", "projectLeader");
		
		//déclaration des Cluster (pour l'affichage avec les cluster)
		var markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
		mapClusters.addLayer(markersLayer);

		//déclaration de la collection de marker geoJson
		var geoJsonCollection = { type: 'FeatureCollection', features: new Array() };
		
		//prépare les données à envoyer au controller pour filtrer la zone de visualisation en cours		
		var bounds = mapClusters.getBounds();
		var params = {};
		params["latMinScope"] = bounds.getSouthWest().lat;
		params["lngMinScope"] = bounds.getSouthWest().lng;
		params["latMaxScope"] = bounds.getNorthEast().lat;
		params["lngMaxScope"] = bounds.getNorthEast().lng;
		//params["origine"] = origine;
		
		//affiche le GIF pendant le chargement de la carte
		$('#btn_reload_map').html(
			'<center><img src="' + assetPath + '/images/sig/ajax-loader.gif" height=22></center>');
		
		//envoie la requête pour récupérer les éléments à afficher sur la carte
		testitpost("", '/ph/communecter/sig/' + origine, params, //ShowMapByOrigine', params,
			function (data){ //alert(JSON.stringify(data));
			
				//mémorise le nom de la carte
				var origineName = data["origine"];
				
				//rend invisible tous les éléments de la liste de droite (pour afficher ensuite seulement les éléments qui sont dans le bound)
				$.each(listIdElementMap[origineName], function() {  //alert(this[0]);	
					$("#item_map_list_" + this[0]).css({ "display" : "none" });				
				});
				
				$.each(data, function() { 
				
					//si on a pas d'identifiant on ne fait rien (=> bug avec le champs origine du fichier json)	
					if(this._id != null){
						
						//mémorise l'identifiant de la donnée en cours					
						var objectId = this._id.$id.toString();
						
						//on traite la donnée seulement si l'élément n'a pas déjà été affiché sur la carte		
						if($.inArray(objectId, listIdElementMap[origineName]) == -1){						
							//on s'assure que l'élément a bien une position géo compatible pour être affichée	 	
							if(this['geo'] != null){ // || this['geoPosition'] != null){
								//alert(JSON.stringify(this));
								//préparation du contenu de la popup
								var content = getPopupCitoyen(this);
								
								//prépare le nom de l'élément
								var name = (this['name'] != null) ? this['name'] : "Anonyme";
		
								//création de l'icon
								var theIcon = L.icon(getIcoMarker(this['tag']));
								
								//création des propriétés du marker
								var properties = { 	_id : objectId,
													icon : theIcon,
													content: content };
													
								//récupération des coordonnées selon la structure de la donnée en cours
								var coordinates;
								if( this['geo']['longitude'] != null ){
										coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
								} else{ coordinates = this['geoPosition']['coordinates']; }
						
								//affiche l'éléments dans la liste de droite
								$("#liste_map_element").append(getItemRigthListMap(this, origineName));
				
								
								var tag = this['tag'] ? this['tag'] : "citoyen";
								
								//si le tag de l'élément est dans la liste de ceux à ne pas mettre dans les clusters
								if($.inArray(tag, notClusteredTag) > -1){ 
									//on créé un marker simple (sans cluster)
									var marker = getMarkerSingle(mapClusters, properties, coordinates);
									
									//evénement au click sur un élément de la liste de droite
									//on affiche la popup et on centre la carte sur le marker correspondant
									$('#item_map_list_'+ objectId).on('click',  
									function(e) { marker.openPopup();  map.panTo(marker.getLatLng()); });
								} 
								//sinon on créé un marker pour les clusters
								else {
									var marker = getGeoJsonMarker(properties, coordinates);
									geoJsonCollection['features'].push(marker);	
								} 
															
								//mémorise l'id de l'élément pour ne pas afficher 2 fois le même
								listIdElementMap[origineName].push(objectId);
								//mémorise les données de l'élément pour effectuer des recherches ultérieures (filtres user name, bounds, etc)
								listDataElementMap[origineName].push({ 	"_id" : objectId, 
																		"coordinates" : coordinates,
																		"name" : name });
																		
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
				
				$('#btn_reload_map').html('<center><img src="' + assetPath + '/images/sig/reload.png" height=30></center>');
		
			});					
	}
	
		
	/**
	***		POPUP MAP
	***/				
	//revoie le contenu des popup (bulle info marker)
	function getPopupCitoyen(citoyen){ //alert(JSON.stringify(citoyen));
	
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
	
	/**
	***		GET MARKERS & ICONS
	***/				
	//créé une donnée marker geoJson
	function getGeoJsonMarker(properties/*json*/, coordinates/*array[lat, lng]*/) {
		return { "type": 'Feature',
				 "properties": properties,
				 "geometry": { type: 'Point',
							 coordinates: coordinates } };
	}

	//***
	//créer un marker unique, en fonction de sa position géographique
	function getMarkerSingle(thisMap, options, coordinates){ //ex : lat = -34.397; lng = 150.644;

		var contentString = options.content ? options.content : "?"; 

		var marker = L.marker(new Array(coordinates[1], coordinates[0]), { icon : options.icon }).addTo(thisMap)
		.bindPopup(contentString);
		
		marker.on('mouseover', function(e) { marker.openPopup(); });
		marker.on('mouseout',  function(e) { marker.closePopup(); });
									
		return marker;
	}
		
	//***
	//récupère le nom de l'icon en fonction du type de marker souhaité
	function getIcoMarker(tag){ //alert(assetPath);
		if(tag == null) tag = "citoyen";
						
  		if(tag == "citoyen") 	return { iconUrl: assetPath + "/images/sig/markers/02_ICON_CITOYENS.png",
												iconSize: 		[14, 14],
												iconAnchor: 	[7, 7],
												popupAnchor: 	[0, -14] };
													
		if(tag == "pixelActif") return { iconUrl: assetPath + "/images/sig/markers/02_ICON_PIXEL_ACTIF.png",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] };	
																								
		if(tag == "partnerPH") 	return { iconUrl: assetPath + "/images/sig/markers/02_ICON_PARTENAIRES.png",
												iconSize: 		[14, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -14] };		
													
		if(tag == "commune") 	return { iconUrl: assetPath + "/images/sig/markers/02_ICON_COMMUNES.png",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] };		
		
		if(tag == "association") 	return { iconUrl: assetPath + "/images/sig/markers/02_ICON_ASSOCIATIONS.png",
												iconSize: 		[15, 13],
												iconAnchor: 	[7,  13],
												popupAnchor: 	[0, -13] };		
		
		if(tag == "projectLeader") 	return { iconUrl: assetPath + "/images/sig/markers/02_ICON_PORTEUR_PROJET.png",
												iconSize: 		[15, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -16] };		
		
		if(tag == "artiste") 	return { iconUrl: assetPath + "/images/sig/markers/02_ICON_ARTISTES.png",
												iconSize: 		[17, 19],
												iconAnchor: 	[8,  19],
												popupAnchor: 	[0, -19] };		
		
		if(tag == "home") 		return { iconUrl: assetPath + "/images/sig/markers/HOME.png",
												iconSize: 		[32, 32],
												iconAnchor: 	[16,  32],
												popupAnchor: 	[0, -32] };			  		
		
		return { iconUrl: assetPath + "/images/sig/markers/02_ICON_CITOYENS.png",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] };			  						
	}
	
	/**
	***		SEARCH BY USERNAME, filtre les éléments de la liste en fonction du nom d'utilisateur recherché par l'utilisateur
	***/
	function searchByUserName(origine, userNameSearch){ 
		//rend invisible tous les éléments de la liste (mais ne les supprime pas)
		$.each(listIdElementMap[origine], function() { 
			if(userNameSearch != "") $("#item_map_list_" + this).css({ "display" : "none" });		
			else $("#item_map_list_" + this).css({ "display" : "inline" });							
		});
		
		//rend visible tous les éléments dont le nom contient la chaine recherchée (regex case insensitive)
		if(userNameSearch != "")
		$.each(listDataElementMap[origine], function() {
			if(this.name != null) {
				if(this.name.search(new RegExp(userNameSearch, "i")) >= 0){ //alert(
					$("#item_map_list_" + this._id).css({ "display" : "inline" });	
				}	
			}		
		});
	
	}
	
	
	/**
	***		RIGHT LIST MAP ELEMENT
	***/
	//affiche dans la liste de droite seulement les éléments visibles sur la carte
	function checkListElementMap(origine){ 	
		//rend invisible tous les éléments de la liste (mais ne les supprime pas
		$.each(listIdElementMap[origine], function() { 
			$("#item_map_list_" + this).css({ "display" : "none" });				
		});
	
		//rend visible tous les éléments qui se trouve dans le bound visible de la carte
		$.each(listDataElementMap[origine], 
			function() { 	
				var bounds = map.getBounds();
		
				if( this.coordinates[0] > bounds.getSouthWest().lng && this.coordinates[0] < bounds.getNorthEast().lng && 
					this.coordinates[1] > bounds.getSouthWest().lat && this.coordinates[1] < bounds.getNorthEast().lat)
					{
						//si le champ de recherche par userName est rempli (n'est pas vide)
						if(this.name != null && $('#input_txt_pseudo_filter').val() != "") {
							//on affiche l'élément seulement s'il correspond à la recherche
							if(this.name.search(new RegExp($('#input_txt_pseudo_filter').val(), "i")) >= 0){
								$("#item_map_list_" + this._id).css({ "display" : "inline" });	
							}	
						}
						else //si le champs de recherche est vide, on affiche l'élément
						$("#item_map_list_" + this._id).css({"display" : "inline" });	
					 }
			});
				
	}
	
	//***
	//renvoi un item (html) pour la liste de droite
	function getItemRigthListMap(element, origine){
		
		//joint le nom de la ville au CP
		var place = "";
		if(element['city'] != null) place += element['city'];
		if(element['city'] != null && element['cp'] != null) place += ", ";	
		if(element['cp'] != null) place += element['cp'];
		
		//prépare le nom (ou "anonyme")
		var name = (element['name'] != null) ? element['name'] : "Anonyme";
		
		//récupère l'url de l'icon a afficher
		var iconUrl = getIcoMarker(element['tag']).iconUrl;
		
		//return l'élément html
		return  '<a id="item_map_list_'+ element._id.$id.toString() +'" href="#" class="item_map_list">' 
						+  '<img class="ico_item_map_list" src="' + iconUrl + '" height=14>'
						+  '<div class="pseudo_item_map_list">' +	name + "</div>"	
						+  '<div class="city_item_map_list">' +	place + "</div>"	
				+  '</a>';	
	}
	
	
	/**
	***		FIND PLACE GEOCODING ( !!! en construction !!! )
	***/
	
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
	
	/**
	***		SHOW MY POSITION (lorsque l'utilisateur est connecté (et s'est localisé),
	***		on affiche sa position sur la carte, et on centre la carte sur lui
	***/
	function showMyPosition(map, origine, myInfos){
		var content = getPopupCitoyen(myInfos);
								
		//création de l'icon pour le marker
		var theIcon = L.icon(getIcoMarker("home"));
		var properties = { 	icon : theIcon,
							content: content };
		
		//récupération des coordonnées
		var coordinates;
		if( myInfos['geo']['longitude'] != null ){
				coordinates = new Array (myInfos['geo']['longitude'], myInfos['geo']['latitude']); }
		else{ 	coordinates = myInfos['geoPosition']['coordinates']; }
		
		
		//création de mon marker sur la carte
		getMarkerSingle(map, properties, coordinates);
		//ajoute mon id dans la liste pour ne jamais l'afficher d'une autre façon (=> showCitoyensClusters()) 
		listIdElementMap[origine].push(myInfos._id.$id.toString());
	}
	
	/**
	***		LOAD MAP, créer une nouvelle carte
	***/
	function loadMap(canvasId, myPosition){

		//création de la carte
		var map = L.map(canvasId, { "zoomControl" : false, 
									"scrollWheelZoom" : false,
									"doubleClickZoom" : true,
									"worldCopyJump" : true }).setView(myPosition, 12);
		
		//choix du style de la carte							
		L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			subdomains: 'abcd',
			minZoom: 2,
			maxZoom: 15
		}).setOpacity(0.4).addTo(map);
	
		//$('#' + canvasId).css({"height" : "100%"; });
		
		return map; 
	}								

	
	/**
	***		INIT MAP, initialiser la carte
	***/
	function initMap(origine, myInfos, myPosition){	
		
		//définition du centre de la carte (par defaut [30.29702, -21.97266])
		var initCenter = (myPosition != null) ? myPosition : [30.29702, -21.97266];
		
		//charge la carte
		map = loadMap("mapCanvas", initCenter);
		
		
		//initialisation de la liste qui permet de vérifier si un élément a déjà été affiché sur la carte
		//(pour ne pas l'afficher plusieurs fois)
		listIdElementMap[origine] = new Array(); 
		
		//initialisation de la liste contenant quelques info sur chaque élément
		listDataElementMap[origine] = new Array(); 
		
		//affiche ma position sur la carte (icon Maison / Home)
		//showMyPosition(map, origine, myInfos);
		
		//lorsque la carte bouge, on vérifie la liste de droite,
		//pour n'afficher que les éléments qui sont visible sur la carte dans le nouveau bound
		map.on('moveend', function(e) {
			checkListElementMap(origine);
		 }); 
		 
		//appèle la fonction principale qui permet de récupérer les éléments à afficher sur la carte 
		showCitoyensClusters(map, origine, listIdElementMap);

		
		//losqu'on click sur le bouton "recharger la carte", on appele la fonction principale
		$('#btn_reload_map').click(function(event) {
			showCitoyensClusters(map, origine, listIdElementMap);
		});
		 
		//lorsqu'on click sur le bouton pour filter la liste de droite par UserName,
		//on lance la recherche !
		$('#btn_pseudo_filter').click(function(event) {
			searchByUserName(origine, $('#input_txt_pseudo_filter').val());
		});
		
		
	}
	
	
	function zoomIn(){ map.zoomIn(); }
	function zoomOut(){ map.zoomOut(); }
	function zoomToMyPosition(){ map.panTo(myPosition); map.setZoom(12); }
	