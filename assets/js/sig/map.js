
	//variable qui permet de charger une instance Sig différente à chaque éxecution
	var SigLoader = new Array();

		SigLoader.getSig = function (){
			
			this.Sig = new Array();

			this.Sig.map = null;
			this.Sig.markersLayer = "";
			this.Sig.tileLayer = null;
			this.Sig.geoJsonCollection = "";

			this.Sig.initParameters = "";

			this.Sig.cssModuleName = "";

			this.Sig.currentFilter = "none";

			this.Sig.icoMarkersTypes = {}; //definition dans map_initializar.js
			this.Sig.icoMarkersTags = {}; //definition dans map_initializar.js

			//mémorise les identifiants des éléments de chaque carte
			this.Sig.listId = new Array();
			this.Sig.listPanel = new Array();
			this.Sig.listPanel.tags = new Array();
			this.Sig.listPanel.types = new Array();

			this.Sig.panelFilter = "all";
			this.Sig.panelFilterType = "all";
			this.Sig.dataMap = {};

			//mémorise les éléments
			this.Sig.elementsMap = new Array();

			//##
			//créer un marker sur la carte, en fonction de sa position géographique
			this.Sig.markerSingleList = new Array();
			this.Sig.popupOpen = false;
			this.Sig.currentMarkerPopupOpen = null;

			this.Sig.mapPolygon = null;
			this.Sig.markerFindPlace = null;

			//##
			//créé une donnée GeoJson (pour les cluster)
			this.Sig.getGeoJsonMarker = function (properties/*json*/, coordinates/*array[lat, lng]*/)
			{
				//console.warn("--------------- getGeoJsonMarker ---------------------");
				properties.visible = false;
				//alert(JSON.stringify(properties));
				return { "type": 'Feature',
						 "properties": properties,
						 "geometry": { type: 'Point',
									 coordinates: coordinates } };
			};


			//##
			//créé un objet L.Marker (sans cluster)
			this.Sig.getMarkerSingle = function(thisMap, options, coordinates)
			{
				//console.warn("--------------- getMarkerSingle ---------------------");
				var thisSig = this;
				var contentString = options.content;
				if(options.content == null) contentString = "";

				var markerOptions = { icon : options.icon };
				if(typeof options.zIndexOffset != "undefined") 
					markerOptions["zIndexOffset"] = options.zIndexOffset;

				//console.log("POPUP CONTENT : " + contentString);
				var marker = L.marker(coordinates, markerOptions)
								.addTo(thisMap)
								.bindPopup(contentString);

				this.markerSingleList.push(marker);

				marker.on('click', function(e) {
						marker.openPopup();
						//Sig.markerToBounce = marker;
						//Sig.bounceMarker(0);
						//https://github.com/hosuaby/Leaflet.SmoothMarkerBouncing : bounce pluggin
						thisSig.currentMarkerPopupOpen = this;							
				});
				marker.on('mouseover', function(e) {
					if(thisSig.map.getZoom() != thisSig.map.getMaxZoom()){
						marker.openPopup();

						//Sig.markerToBounce = marker;
						//Sig.bounceMarker(0);
						//https://github.com/hosuaby/Leaflet.SmoothMarkerBouncing : bounce pluggin
						thisSig.currentMarkerPopupOpen = this;	
					}						
				});
				return marker;
			};

			this.Sig.timerbounce = null;
			// EXEMPLE : 
			// Sig.bounceMarker(0, { duration: 500, 	//va effectuer un saut pendant 500 miliemes de secondes
			// 				  height: 15,				//d'une hauteur de 15px
			// 				  interval: 2000,			//toutes les 2 secondes
			// 				  occurence:5 });			//5 fois de suite
			this.Sig.bounceMarker = function(i, options){
				//Sig.markerToBounce.bounce({duration: 500, height: 30});
				if(typeof Sig.markerToBounce === "undefined" || Sig.markerToBounce === null) {
					if(typeof this.timerbounce != "undefined")
						clearTimeout(this.timerbounce);
					return;
				}

				i++;
				//console.log(i);
				if(i < options.occurence){
					this.timerbounce = setTimeout(function(){ 
						if(typeof Sig.markerToBounce != "undefined" && Sig.markerToBounce != null){
							Sig.markerToBounce.bounce({duration: options.duration, height: options.height}); 
							Sig.bounceMarker(i, options); 
						}
					}, options.interval);
				}else{
					clearTimeout(this.timerbounce);
				}
			};

			//##
			//récupère le nom de l'icon en fonction du type de marker souhaité
			this.Sig.getIcoMarkerMap = function(thisData)
			{
				//console.warn("--------------- getIcoMarker *** ---------------------");
				//console.log(thisData);
				if(typeof thisData.author != "undefined") thisData = thisData.author;

				this.allowMouseoverMaker = true;

				var markerName = this.getIcoNameByType(thisData);
				var iconUrl = assetPath+'/images/sig/markers/'+markerName+'.png';
				if(typeof thisData.profilMarkerImageUrl !== "undefined" && thisData.profilMarkerImageUrl != "") 
					iconUrl = baseUrl + thisData.profilMarkerImageUrl;

				return L.icon({
				    iconUrl: iconUrl,
				    iconSize: [53, 60], //38, 95],
				    iconAnchor: [27, 57],//22, 94],
				    popupAnchor: [0, -55]//-3, -76]
				});
			};

			this.Sig.getIcoMarker = function(thisData)
			{
				//console.warn("--------------- getIcoMarker ---------------------");
				var ico = this.getIcoNameByType(thisData);
				var color = this.getIcoColorByType(thisData);

				return L.AwesomeMarkers.icon({icon: ico + " fa-" + color, iconColor:color, prefix: 'fa' });
			};


			//##
			//supprime tous les marker de la carte
			this.Sig.clearMap = function(thisMap, showMe)
			{
				if(typeof showMe == "undefined") showMe = true;

				console.warn("--------------- clearMap ---------------------");
				if(this.markersLayer != "")
					this.markersLayer.clearLayers();

				if(typeof this.myMarker != "undefined") 
					this.map.removeLayer(this.myMarker);
				
				if(this.markerModifyPosition != null) 
					this.map.removeLayer(this.markerModifyPosition);

				var thisSig = this;
				if(this.markerSingleList != null)
				$.each(this.markerSingleList, function(){
					thisSig.map.removeLayer(this);
				});

				this.clearPolygon();

				this.listId = new Array();
				this.elementsMap = new Array();
				this.changePagination(1);
				
				$( this.cssModuleName + " #liste_map_element").html("");

				showMe = false;
				if(showMe)
				this.showMyPosition();

			};

			//##
			//supprime tous les marker de la carte et prépare pour recharger de nouvelles données
			this.Sig.restartMap = function(thisMap)
			{	
				//supprime les item panel (sauf all)
				$.each($(this.cssModuleName + " .item_panel_map"), function(){
					if($(this).attr("id") != "item_panel_map_all" && $(this).attr("id") != "item_panel_filter_all")
						$(this).remove();
				});
				$(this.cssModuleName + " #liste_map_element").html();

				this.listPanel.tags = new Array();
				this.listPanel.types = new Array();
				this.panelFilter = "all";
				this.panelFilterType = "all";
				this.clearMap(thisMap);
				this.currentMarkerPopupOpen = null;
			};

			this.Sig.showMyPosition = function(){
				var thisSig = this;
				if(thisSig.myPosition != null){
					//console.log("MYPOSITION !!");
					//console.dir(thisSig.myPosition);
					var center = [thisSig.myPosition.position.latitude, 
								  thisSig.myPosition.position.longitude];

					var popup = Sig.getPopupSimple(Sig.userData);
					var properties = { 	id : "0",
										icon : thisSig.getIcoMarkerMap(thisSig.myPosition),
										type : thisSig.myPosition["type"],
										typeSig : thisSig.myPosition["typeSig"],
										faIcon : this.getIcoByType(thisSig.myPosition),
										zIndexOffset: 10000,
										content: popup };

					if(typeof thisSig.myMarker != "undefined") thisSig.map.removeLayer(thisSig.myMarker);
					thisSig.myMarker = thisSig.getMarkerSingle(thisSig.map, properties, center);
					thisSig.createItemRigthListMap(thisSig.userData, thisSig.myMarker, thisSig.map);

					var objectId = thisSig.getObjectId(thisSig.userData);
					this.listId = new Array(objectId);

					$(this.cssModuleName + " .item_map_list_" + objectId).click(function()
					{	thisSig.map.panTo(center, {"animate" : true });
						thisSig.checkListElementMap(thisSig.map);
						thisSig.myMarker.openPopup();
					});
					
					$( "#btn-home" ).off().click(function (){ 
							thisSig.map.setView(center, 16);
					});
					$( ".btn-home" ).off().click(function (){ 
							thisSig.centerSimple(center, 16);
					});
				}
			}
			//gère les dimensions des différentes parties de la carte (carte, panel, etc) en mode full screen
			this.Sig.setFullScreen = function()
			{
				////console.warn("--------------- setFullScreen ---------------------");
				//full screen map
				var mapHeight = $(".subviews.subviews-top").height();// - $(".toolbar").height();
				var rightListHeight = mapHeight - 110;

				$("#mapCanvas" + this.sigKey).css({"height":mapHeight});
				//alert(mapHeight);
				$("#mapCanvas" + this.sigKey).css({"margin-bottom":mapHeight*(-1)});
				$(this.cssModuleName + " #right_tool_map").css({"height":rightListHeight+25});
			
				$(this.cssModuleName + " #liste_map_element").css({"height":rightListHeight - $(this.cssModuleName + " #map_pseudo_filters").height() - 8*2 /*padding*/ - $(this.cssModuleName + " #chk-scope").height() - 33 });
				$(this.cssModuleName + " #liste_map_element").css({"max-height":rightListHeight - $(this.cssModuleName + " #map_pseudo_filters").height() - 8*2 /*padding*/ - $(this.cssModuleName + " #chk-scope").height() - 33  });
				
				$(this.cssModuleName + " #right_tool_map").css(		{"left":$("#mapCanvas" + this.sigKey).width() - $("#right_tool_map").width() - 20 });// - $(this.cssModuleName + " #right_tool_map").width()});
				$(this.cssModuleName + " .input-search-place").css( {"left":$("#mapCanvas" + this.sigKey).width() - $("#right_tool_map").width() - $(this.cssModuleName + " #right_tool_map").width() - 20});// - $(this.cssModuleName + " #right_tool_map").width()});
			
				$(this.cssModuleName + " .panel_map").css({"max-height":rightListHeight - 8*2 /*padding*/ - 33 });
				
			};

			//gère les dimensions des différentes parties de la carte (carte, panel, etc) en mode normal
			this.Sig.setNoFullScreen = function()
			{ 
				var mapHeight = this.initParameters.mapHeight;
				var rightListHeight = mapHeight - 100;

				var left = $(this.cssModuleName + " #right_tool_map").position().left - $(this.cssModuleName + " .input-search-place").width() - 20;
				$(this.cssModuleName + " .input-search-place")	.css({"left": left});// - $(this.cssModuleName + " #right_tool_map").width()});
			};

			//gère les dimensions des différentes parties de la carte (carte, panel, etc) en mode normal
			this.Sig.setFullPage = function()
			{ 
				var mapHeight = $("#mapCanvasBg").height();
				var rightPanelHeight = mapHeight - 140;

				$(this.cssModuleName + " #right_tool_map").css({"height":rightPanelHeight});
				$(this.cssModuleName + " #liste_map_element").css({"height":rightPanelHeight-100});
				$(this.cssModuleName + " #liste_map_element").css({"maxHeight":rightPanelHeight-100});
				
				$(this.cssModuleName + " .panel_map").css({"max-height":rightPanelHeight - 8*2 /*padding*/ - 45 });
				

				$(this.cssModuleName + " .tools-btn").css( 
					{"left":$("#mapCanvas" + this.sigKey).width() - 
					$("#right_tool_map").width() - 
					$(this.cssModuleName + " .tools-btn").width() - 20});// - $(this.cssModuleName + " #right_tool_map").width()});
				
				$(this.cssModuleName + " .input-search-place").css( {"left":90} );

				var left = $(this.cssModuleName + " .tools-btn").position().left;
				var top = $(this.cssModuleName + " .btn-group-map").position().top + $(this.cssModuleName + " #btn-filter").height();
	
			};

			//modifie la position et la forme des éléments de l'interface de facon dynamique
			this.Sig.constructUI = function()
			{
				
				if(this.initParameters.useFullScreen){
					this.setFullScreen();
				}
				else{
					this.setNoFullScreen();
				}

				if(this.initParameters.useFullPage){ this.setFullPage(); }

			}

			this.Sig.verifyPanelFilter = function (thisData){
				//console.warn("--------------- verifyPanelFilter ---------------------");

				if(this.panelFilter == "all") return true;

				var thisSig = this;
				//console.log("PANELFILTER" + this.panelFilterType);
				if(this.panelFilterType == "tags" || this.panelFilterType == "all"){
					if(this.usePanel == false) return true;
					//console.log(thisData["tags"] +"=="+ thisSig.panelFilter);
					
					//si thisData n'a pas de tags
					if("undefined" == typeof thisData["tags"]){
						return (this.panelFilter == "all");
					}


					var inArray = false;
					if(typeof thisData["tags"] != "undefined" && thisData["tags"] != null)
					$.each(thisData["tags"], function(index, value){
						if(value == thisSig.panelFilter) inArray = true;
					});

					if(	inArray //$.inArray(this.panelFilter, thisData["tags"]) > -1 //ne fonctionne pas
						||  this.panelFilter == "all") {
							return true;
					}
					else{ return false; }

				}
				
				if(this.panelFilterType == "types" || this.panelFilterType == "all"){
					if(this.useFilterType == false) return true;

					//si thisData n'a pas de tags
					if("undefined" == typeof thisData["type"] && "undefined" == typeof thisData["typeSig"]){
						return (this.panelFilter == "all");
					}
					if(		thisData["type"] == thisSig.panelFilter
						||  thisData["typeSig"] == thisSig.panelFilter
						||  this.panelFilter == "all") {
							return true;
					}
					else{ return false; }

				}
			};

			this.Sig.polygonsCollection = new Array();

			this.Sig.addPolygon = function(polygonPoints, options)
			{
				console.log("addPolygon");
				var poly = L.polygon(polygonPoints, {
										color: '#FFF', 
										opacity:0.7,
										fillColor: '#71A4B4', 
										fillOpacity:0.3,  
										weight:'2px', 
										smoothFactor:0.5}).addTo(this.map);

				this.polygonsCollection.push(poly);
			};

			this.Sig.clearPolygon = function()
			{
				var thisSig = this;
				$.each(this.polygonsCollection, function(key, poly){
					thisSig.map.removeLayer(poly);
				});
				this.polygonsCollection = new Array();
			};

			this.Sig.showPolygon = function(polygonPoints, options)
			{
				console.log("showPolygon");
				//console.dir(polygonPoints);
				//si le polygone existe déjà on le supprime
				if(this.mapPolygon != null) this.map.removeLayer(this.mapPolygon);
				//puis on charge le nouveau polygone
				this.mapPolygon = L.polygon(polygonPoints, {
										color: '#FFF', 
										opacity:0.7,
										fillColor: '#71A4B4', 
										fillOpacity:0.3,  
										weight:'2px', 
										smoothFactor:0.5}).addTo(this.map);
			};

			this.Sig.inversePolygon = function(polygon){
				var inversedPoly = new Array();
				console.log("inversePolygon");
				if(typeof polygon != "undefined" && polygon != null){
					$.each(polygon, function(key, value){
						var lat = value[0];
						var lng = value[1];
						inversedPoly.push(new Array(lng, lat));
					});
				}
				console.dir(inversedPoly);
				return inversedPoly;
			};

			this.Sig.getCoordinates = function(thisData, type)
			{
				//console.warn("--------------- getCoordinates ---------------------");
				//console.dir(thisData);
				//si la donnée est une news, on doit afficher la position de l'auteur
				if( typeof thisData.typeSig !== "undefined"){
					if(thisData.typeSig == "news" && typeof thisData.author !== "undefined"){
						thisData = thisData.author;
					}
				}

				if( typeof thisData.geo !== "undefined" && thisData.geo != null && typeof thisData.geo.longitude !== "undefined"){
					if(type == "markerSingle")
						return new Array (thisData['geo'].latitude, thisData['geo'].longitude);
					else if(type == "markerGeoJson")
						return new Array (thisData['geo'].longitude, thisData['geo'].latitude);
				}
				else if(typeof thisData.geoPosition != "undefined"){
					if(type == "markerSingle"){
						var lat = thisData.geoPosition.coordinates[1];
						var lng = thisData.geoPosition.coordinates[0];
						return new Array (lat, lng);
					} else if(type == "markerGeoJson"){
						return thisData.geoPosition.coordinates;
					}
				}
				else if(typeof thisData.geometry != "undefined"){ //resultat search street on google map
					console.log("thisData.geometry ?");
					console.dir(thisData);
					if(type == "markerSingle"){
						if(typeof thisData.geometry.location != "undefined"){
							console.log(thisData.geometry.location.lat);
							var lat = thisData.geometry.location.lat;
							var lng = thisData.geometry.location.lng;
							console.dir(new Array (lat, lng));
							return new Array (lat, lng);
						}	
					} else if(type == "markerGeoJson"){
						if(typeof thisData.geometry.location != "undefined"){
							var lat = thisData.geometry.location.lat;
							var lng = thisData.geometry.location.lng;
							return new Array (lng, lat);
						}
					}
				}
				else{
					return null;
				}
			};


			this.Sig.showOneElementOnMap = function(thisData, thisMap){
				//console.warn("--------------- showOneElementOnMap ---------------------");
				//console.dir(thisData);
				//var objectId = thisData._id ? thisData._id.$id.toString() : null;
				var objectId = this.getObjectId(thisData);
				//console.log("verify id : ", objectId);
				//if(thisData != null && thisData["type"] == "meeting") alert("trouvé !");
				// console.log(thisData);
				if(objectId != null)
				{
					if($.inArray(objectId, this.listId) == -1 || thisData.typeSig == "city")
					{			
						if(("undefined" != typeof thisData['geo'] && thisData['geo'] != null) || ("undefined" != typeof thisData['geoPosition'] && thisData['geoPosition'] != null) ||
							("undefined" != typeof thisData['author'] && ("undefined" != typeof thisData['author']['geo'] || "undefined" != typeof thisData['author']['geoPosition']))) {
							if(this.verifyPanelFilter(thisData))
							{
								var type = (typeof thisData["typeSig"] !== "undefined") ? thisData["typeSig"] : thisData["type"];
								//préparation du contenu de la bulle
								var content = this.getPopup(thisData);
								//création de l'icon sur la carte
								var theIcon = this.getIcoMarkerMap(thisData);
								var properties = { 	id : objectId,
													icon : theIcon,
													type : thisData["type"],
													typeSig : type,
													name : thisData["name"],
													faIcon : this.getIcoByType(thisData),
													content: content };

								var marker;
								var coordinates;

								//si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
								//on créé un marker simple
								//TODO : refactor notClusteredTag > notClusteredType
								
								if($.inArray(type, this.notClusteredTag) > -1){
									coordinates = this.getCoordinates(thisData, "markerSingle");
									marker = this.getMarkerSingle(thisMap, properties, coordinates);
								}
								//sinon on crée un nouveau marker pour cluster
								else {
									coordinates = this.getCoordinates(thisData, "markerGeoJson");
									marker = this.getGeoJsonMarker(properties, coordinates);
									this.geoJsonCollection['features'].push(marker);
								}


								if(thisData["type"] == "city"){
									//console.log("geoshapes ?");
									//console.dir(thisData);	
										
									if(typeof thisData["geoShape"] != "undefined" && typeof thisData["geoShape"]["coordinates"] != "undefined"){
										var geoShape = Sig.inversePolygon(thisData["geoShape"]["coordinates"][0]);
										this.addPolygon(geoShape);
									}
								}
								
								this.elementsMap.push(thisData);
								this.listId.push(objectId);
								this.populatePanel(thisData, objectId); //["tags"]
								this.createItemRigthListMap(thisData, marker, thisMap);
								
								//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
								//si le marker n'est pas dans un cluster (sinon le click est géré dans le .geoJson.onEachFeature)
								if($.inArray(type, this.notClusteredTag) > -1)
								$(this.cssModuleName + " .item_map_list_" + objectId).click(function()
								{	thisMap.panTo(coordinates, {"animate" : true });
									thisSig.checkListElementMap(thisMap);
									marker.openPopup();
								});
								//console.log("ok888");


							}
						}
						else{
							if(this.verifyPanelFilter(thisData) && typeof thisData.name != "undefined"){
								this.elementsMap.push(thisData);
								this.listId.push(objectId);
								this.populatePanel(thisData, objectId); //["tags"]
								this.createItemRigthListMap(thisData);	
								$(this.cssModuleName + " .item_map_list_" + objectId).click(function(){	
									//toastr.success('click on element not in map');
									//console.dir(thisData);
									thisSig.showModalItemNotLocated(thisData);
								});	
							}	
						}


				
					}
					

					//affiche les MEMBERS
					var thisSig = this;
					if(thisData.links != null)
						if(thisData.links.members != null){
							$.each(thisData.links.members, function(i, thisMember)  {
								thisMember._id = { $id : i };
								thisSig.showOneElementOnMap(thisMember, thisMap);
							});
						}

					}else {
						if(thisData == null) return false;

						//console.warn("--------------- PAS D'ID ---------------------");
						//console.dir(thisData);

						if("undefined" != typeof thisData["chartOptions"]){
							//console.warn("--------------- LOAD CHART ---------------------");
							this.addChart(thisData)
						}
						return false;
					}
					

			};

			this.Sig.showFilterOnMap = function(data, thisFilter, thisMap){
				//console.warn("--------------- showFilterOnMap ***%%% ---------------------");
				var thisSig = this;
				var dataFilter = (data != null) ? data[thisFilter] : thisFilter;	//alert(JSON.stringify(dataFilter));
				
				if($.isArray(dataFilter)){
					$.each(dataFilter, function(i, thisData)  {
						////console.warn("--------------- show each thisData ---------------------");
						////console.dir(thisData);

						thisSig.showOneElementOnMap(thisData, thisMap);
					});
				}
				else{
					thisSig.showOneElementOnMap(dataFilter, thisMap);
				}
			};


			this.Sig.showMapElements = function(thisMap, data)
			{
				console.warn("--------------- showMapElements ---------------------");
				// console.log(data);
				if(data == null) return;

				var filterPanelValue = "citoyens";
				//enregistre les dernières données dans une variable locale
				this.dataMap = data;
				//alert("datas : " + JSON.stringify(this.dataMap));
				//efface les elements de la carte si elle n'est pas vide
				if(this.markersLayer != "") this.clearMap(thisMap);

				//conteneur de marker cluster
				this.markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
				thisMap.addLayer(this.markersLayer);

				//collection de marker geojson
				this.geoJsonCollection = { type: 'FeatureCollection', features: new Array() };

				//this.showIcoLoading(true);

				//on affiche les data filtre par filtre
				var thisSig = this;
				//var array = new Array();

				var len = 0;

				$.each(data, function (key, value){ len++; });//alert("len : " + len);
				if(len >= 1){
					$.each(data, function (key, value){
						var oneData = key;
						if((value.typeSig == "news" /*|| value.typeSig == "activityStream"*/) && typeof value.author !== "undefined") 
							oneData = key.author;
						thisSig.showFilterOnMap(data, key, thisMap);
					});
					
				}else{
					thisSig.showOneElementOnMap(data, thisMap);
				}


				
				var points = L.geoJson(this.geoJsonCollection, {				//Pour les clusters seulement :
						onEachFeature: function (feature, layer) {				//sur chaque marker
							layer.bindPopup(feature["properties"]["content"]); 	//ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   	//affiche l'icon demandé
							layer.on('mouseover', function(e) {	
								//si le mouseover n'est pas autorisé
								//ou si le zoom de la carte est = au zoom maximum (== ouverture cluster spiral)
								if(thisSig.allowMouseoverMaker == false  || 
								   thisSig.map.getZoom() == thisSig.map.getMaxZoom()) return;

								layer.openPopup(); 
								thisSig.currentMarkerPopupOpen = layer;
							});
							layer.on('click', function(e) {	
								thisSig.currentMarkerPopupOpen = layer;
								thisMap.panTo(layer.getLatLng());	
								layer.openPopup(); 
								
							});
							
							//au click sur un element de la liste de droite, on zoom pour déclusturiser, et on ouvre la bulle
							$(thisSig.cssModuleName + " .item_map_list_" + feature.properties.id).click(function(){
								thisSig.allowMouseoverMaker = false;
								var coordinates =  [feature.geometry.coordinates[1], 
													feature.geometry.coordinates[0]];
								thisMap.panTo(coordinates, {"animate" : false });
								
								var visibleOne = null;
								if(typeof layer != "undefined")
									visibleOne = Sig.markersLayer.getVisibleParent(layer);
								
								if(typeof visibleOne != "undefined"){
									if(typeof visibleOne._childCount != "undefined"){
										var i = 0;
										while(typeof visibleOne._childCount != "undefined" && i<5){
											coordinates = visibleOne.getLatLng();
											thisMap.panTo(coordinates, {"animate" : false });
											visibleOne.fire("click");
											if(typeof layer != "undefined")
												visibleOne = Sig.markersLayer.getVisibleParent(layer);
											thisSig.currentParentToOpen = visibleOne;
											i++;
										}
									}
									else{
										if(typeof visibleOne._spiderLeg == "undefined")	{
											thisMap.fire("click");
											thisMap.setZoom(15, {"animate" : false });
											thisMap.panTo(coordinates, {"animate" : false });
											thisSig.currentParentToOpen = null;
								
										}
									}
								}
								thisSig.checkListElementMap(thisMap);
								thisSig.currentMarkerToOpen = layer;
								thisSig.currentMarkerPopupOpen = layer;
								setTimeout("Sig.openCurrentMarker()", 700);
							});						
						}

					});
					////console.warn("--------------- showMapElements  onEachFeature OK ---------------------");

					this.markersLayer.addLayer(points); 		// add it to the cluster group
					thisMap.addLayer(this.markersLayer);		// add it to the map

					$('#ico_reload').removeClass("fa-spin");
					$('#ico_reload').css({"display":"none"});

					if(this.initParameters.usePanel)
						this.updatePanel(thisMap);

					this.checkListElementMap(thisMap); 
					
					//console.log("fitBounds");
					//console.dir(this.markersLayer.getBounds());
					if("undefined" != typeof this.markersLayer.getBounds() &&
					   "undefined" != typeof this.markersLayer.getBounds()._northEast ){
						thisMap.fitBounds(this.markersLayer.getBounds(), { 'maxZoom' : 14 });
						thisMap.zoomOut();
					}

					thisSig.constructUI();

					this.showIcoLoading(false);

		};

		//##
		this.Sig.openCurrentMarker = function(){
			if(typeof this.currentParentToOpen != "undefined" && this.currentParentToOpen != null)
				this.currentParentToOpen.fire("click");

			if(typeof this.currentMarkerToOpen != "undefined" && this.currentMarkerToOpen != null)
				this.currentMarkerToOpen.openPopup();

			this.allowMouseoverMaker = true;
		};


		//##
		//##	LOAD MAP	##
		//##

		//##
		//chargement de la carte
	 	this.Sig.loadMap = function(canvasId, initParams)
	 	{
	 		
			console.warn("--------------- loadMap ---------------------");
			canvasId += initParams.sigKey;
			if(this.map == null){
				$("#"+canvasId).html("");
				$("#"+canvasId).css({"background-color": this.mapColor});

				//initialisation des variables de départ de la carte
				if(canvasId != "")
				var map = L.map(canvasId, { "zoomControl" : false,
											"scrollWheelZoom":true,
											"center" : [51.505, -0.09],
											"zoom" : 4,
											"worldCopyJump" : false });
			}else{
				var map = this.map;
			}
			//initialisation de l'interface
			Sig.initEnvironnement(map, initParams);
			if(canvasId == "") return;

			Sig.tileLayer = L.tileLayer(initParams.mapTileLayer, { //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
				//attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
				attribution: 'Map tiles by ' + initParams.mapAttributions, //'Map tiles by <a href="http://stamen.com">Stamen Design</a>',
				//subdomains: 'abc',
				minZoom: 3,
				maxZoom: 20
			});

			Sig.tileLayer.setOpacity(initParams.mapOpacity).addTo(map);
			
			var roadTileLayer = L.tileLayer('//otile{s}-s.mqcdn.com/tiles/1.0.0/{type}/{z}/{x}/{y}.{ext}', {
							type: 'hyb',
							ext: 'png',
							attribution: 'Tiles Courtesy of <a href="http://www.mapquest.com/">MapQuest</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
							subdomains: '1234',
							opacity: 0.7,
							minZoom:12,
							maxZoom: 20
						});
			roadTileLayer.addTo(map);
			
			//rafraichi les tiles après le redimentionnement du mapCanvas
			map.invalidateSize(false);
			return map;
		};

		//show a modal when an item in the right list has no geoLocation on the map
		this.Sig.showModalItemNotLocated = function(data){
			$("#modalItemNotLocated").modal('show');
			$("#modalItemNotLocated .modal-body").html("<i class='fa fa-spin fa-reload'></i>");

			var objectId = this.getObjectId(data);
			var popup = this.getPopupSimple(data);
			$("#modalItemNotLocated .modal-body").html(popup);
			$("#modalItemNotLocated #btn-open-details").click(function(){
				$("#popup"+objectId).click();
			});

			$("#modalItemNotLocated #popup"+objectId).click(function(){
				$("#modalItemNotLocated").modal('hide');
			});
		}

		this.Sig = this.getSigInitializer(this.Sig);

		console.log("load");

		this.Sig = this.getSigPanel(this.Sig);
		this.Sig = this.getSigRightList(this.Sig);
		this.Sig = this.getSigPopupContent(this.Sig);
		this.Sig = this.getSigFindPlace(this.Sig);
		this.Sig = this.getSigCharts(this.Sig);

		return this.Sig;
	};
