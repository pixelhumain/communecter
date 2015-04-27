
	//variable qui permet de charger une instance Sig différente à chaque éxecution
	var SigLoader = new Array();
	
		SigLoader.getSig = function (){ 
			
			this.Sig = new Array();
			
			this.Sig.markersLayer = "";
			
			this.Sig.geoJsonCollection = "";
			
			this.Sig.initParameters = "";
			
			this.Sig.cssModuleName = "";
			
			this.Sig.currentFilter = "none";
			
			this.Sig.icoMarkersTypes = {}; //definition dans map_initializar.js
			this.Sig.icoMarkersTags = {}; //definition dans map_initializar.js
			
			//mémorise les identifiants des éléments de chaque carte
			this.Sig.listId = new Array();
			this.Sig.listPanel = new Array();
			this.Sig.panelFilter = "all";
			this.Sig.dataMap = {};
			
			//mémorise les éléments
			this.Sig.elementsMap = new Array();
			
			//##
			//créer un marker sur la carte, en fonction de sa position géographique
			this.Sig.markerSingleList = new Array();
			this.Sig.popupOpen = false;
										
		
			//##
			//créé une donnée GeoJson (pour les cluster)
			this.Sig.getGeoJsonMarker = function (properties/*json*/, coordinates/*array[lat, lng]*/) 
			{
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
				var contentString = options.content;
				if(options.content == null) contentString = "info window"; 
		
				var markerOptions = { icon : options.icon };
		
				var marker = L.marker(coordinates, markerOptions).addTo(thisMap)
																 .bindPopup(contentString);
				
				this.markerSingleList.push(marker);
				
				marker.on('click', function(e) { 
						marker.openPopup(); 
				});
				
				
				return marker;
			};
			
			//##
			//récupère le nom de l'icon en fonction du type de marker souhaité
			this.Sig.getIcoMarker = function(thisData)
			{	
				var type = thisData["type"];
				var ico = this.getIcoNameByType(type);
				var color = this.getIcoColorByType(type);
				
				return L.AwesomeMarkers.icon({icon: ico + " fa-" + color, iconColor:color, prefix: 'fa' });	
			};
		
		
			//##
			//supprime tous les marker de la carte
			this.Sig.clearMap = function(thisMap)
			{
				if(this.markersLayer != "")
					this.markersLayer.clearLayers();
				
				$.each(this.markerSingleList, function(){
					thisMap.removeLayer(this);
				});
				
				this.listId = new Array();
				this.listPanel = new Array();
				$( this.cssModuleName + " #liste_map_element").html("");
				
			};
			
			
			//## TODO : UTILISER cette fonction pour gérer le fullScreenMap
			//gère les dimensions des différentes parties de la carte (carte, panel, etc)
			this.Sig.resizeMap = function()
			{
				return;
				//full screen map
				var mapHeight = $("body").height() - $(".topbar").height() - $(".toolbar").height() - $("footer").height() - 1;
				$("#mapCanvas").css({"height":mapHeight});
				$("#mapCanvas").css({"margin-bottom":mapHeight*(-1)});
				$("#right_tool_map").css({"height":mapHeight});
				$("#liste_map_element").css({"height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ - $("#chk-scope").height() - 33 });
				$("#liste_map_element").css({"max-height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ });
				$("#right_tool_map").css({"left":$("#carto").width() - $("#right_tool_map").width()});
				$(".btn-group-map").css({"margin-top":$(".panel_map").height()*(-1) - 20});
				
			};
			
			this.Sig.verifyPanelFilter = function (thisData){
				
				if(this.usePanel == false) return true;
				
				//si thisData n'a pas de tags
				if("undefined" == typeof thisData["tags"]) { return true; }
				
				var thisSig = this;
				var inArray = false;
				$.each(thisData["tags"], function(index, value){ 
					if(value == thisSig.panelFilter) inArray = true;
				});
				
				if(		inArray //$.inArray(this.panelFilter, thisData["tags"]) > -1 //ne fonctionne pas
					||  this.panelFilter == "all") {
						return true;
				}
				else{ return false; }
			};
			
			this.Sig.showOneElementOnMap = function(thisData, thisMap){
				
				var objectId = thisData._id ? thisData._id.$id.toString() : null;
				if(objectId != null) 
				{
					if("undefined" != typeof thisData['geo'] || "undefined" != typeof thisData['geoPosition']){
						if(this.verifyPanelFilter(thisData))
						{
							//préparation du contenu de la bulle
							var content = this.getPopupCitoyen(thisData);
						
							//création de l'icon sur la carte
							var theIcon = this.getIcoMarker(thisData);
							var properties = { 	id : objectId,
												icon : theIcon,
												content: content };

							var coordinates;
							if( thisData['geo'].longitude != null ){
								coordinates = new Array (thisData['geo'].longitude, thisData['geo'].latitude); 
							} 
							else 
							{ 							  	  	 
								coordinates = thisData.geoPosition.coordinates; 
							}
								
							var marker;
							//si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
							//on créé un marker simple
							//TODO : refactor notClusteredTag > notClusteredType
							if($.inArray(thisData['type'], this.notClusteredTag) > -1){ 

								
								marker = this.getMarkerSingle(thisMap, properties, coordinates);
						
								//si l'élément n'est pas déjà dans la liste, on recrée le marker et on l'enregistre
								if($.inArray(objectId, this.listId) == -1)
								{	
									this.elementsMap.push(thisData);
									this.listId.push(objectId);
									this.populatePanel( tag, objectId );
									
									//affiche l'éléments dans la liste de droite
									$("#liste_map_element").append(this.createItemRigthListMap(thisData, marker));
									//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
									$("#item_map_list_" + objectId).click(function()
									{
										thisMap.panTo(marker.getLatLng(), {"animate" : true });
										this.checkListElementMap(thisMap);
										marker.openPopup();
									});
								}
							} 
							//sinon on crée un nouveau marker pour cluster
							else{
								marker = this.getGeoJsonMarker(properties, coordinates);
								this.geoJsonCollection['features'].push(marker);	
							else
							{
								
								marker = this.getGeoJsonMarker(properties, coordinates);
								this.geoJsonCollection['features'].push(marker);	
																
							}
						
							//si l'élément n'est pas déjà dans la liste, on l'enregistre
							if($.inArray(objectId, this.listId) == -1)
							{	
								this.elementsMap.push(thisData);	
								this.listId.push(objectId);
								this.populatePanel(thisData["tags"], objectId);	
								//affiche l'éléments dans la liste de droite
								$(this.cssModuleName + " #liste_map_element").append(this.createItemRigthListMap(thisData, marker));							
							}	
						} 
													
					}
					
					
					//affiche les LINKS et les MEMBERS
					var thisSig = this;
					if(thisData.links != null)
						if(thisData.links.members != null){
							$.each(thisData.links.members, function(i, thisMember)  { 	
								thisMember._id = { $id : i };
								thisSig.showOneElementOnMap(thisMember);
							});	
						}
					
					
				}
				
			};
			
			this.Sig.showFilterOnMap = function(data, thisFilter, thisMap){
				
				var thisSig = this;
				var dataFilter = data[thisFilter];	
				if(dataFilter.length > 1){
					$.each(dataFilter, function(i, thisData)  { 
						
						thisSig.showOneElementOnMap(thisData, thisMap);
					});	
				}
				else{
					thisSig.showOneElementOnMap(dataFilter, thisMap);
				}	
			
					
			};
			
			
			this.Sig.showMapElements = function(thisMap, data)
			{ 
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
				
				this.showIcoLoading(true);
				
				//on affiche les data filtre par filtre, en suivant la Desc des datas
				var thisSig = this;
				
				$.each(data, function (key, value){
					thisSig.showFilterOnMap(data, key, thisMap);
				});
				
				var points = L.geoJson(this.geoJsonCollection, {				//Pour les clusters seulement :
						onEachFeature: function (feature, layer) {				//sur chaque marker
							layer.bindPopup(feature["properties"]["content"]); 	//ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   	//affiche l'icon demandé
							layer.on('mouseclick', function(e) {	layer.openPopup(); });
							
							//au click sur un element de la liste de droite, on zoom pour déclusturiser, et on ouvre la bulle
							$(thisSig.cssModuleName + " #item_map_list_" + feature.properties.id).click(function(){
								thisMap.setView([feature.geometry.coordinates[1], 
											  feature.geometry.coordinates[0]], 
											  13, {"animate" : true });
							    
								thisSig.checkListElementMap(thisMap); //alert("check");
								layer.openPopup();
							});
						}
					});
					
					this.markersLayer.addLayer(points); 		// add it to the cluster group
					thisMap.addLayer(this.markersLayer);		// add it to the map
					
					$('#ico_reload').removeClass("fa-spin");
					$('#ico_reload').css({"display":"none"});
				
					if(this.initParmerters.usePanel)
						this.updatePanel(thisMap);
					
					this.checkListElementMap(thisMap);
					this.showIcoLoading(false);
				
		};
		
			
		//##
		//##	PANEL FILTER	##
		//##
		
		this.Sig.changeFilter = function (val, thisMap)
		{ 	
			if(this.panelFilter != "")
				$(this.cssModuleName + '#item_panel_map_' + this.panelFilter).removeClass("selected");	
			
			this.panelFilter = val;	
			$(this.cssModuleName + '#item_panel_map_' + this.panelFilter).addClass("selected");	
			this.showMapElements(thisMap, this.dataMap);	
		};	
		
		
		this.Sig.populatePanel = function(tags, objectId){  
			var thisSig = this;
			if("undefined" == typeof tags) tags = new Array("all");
			//alert("tags : " + tags);
			$.each(tags, function(){
				thisSig.listPanel.push(this); //new Array(objectId);
			});
			
		};
		
		
		this.Sig.updatePanel = function(thisMap){ //alert("updatePanel : " + JSON.stringify(this.listPanel));
			var thisSig = this;
			$.each(this.listPanel, function(key, value){
				//si l'item n'existe pas encore
				//alert("value : " + this);
				var valueId = value.replace(/\s/g,"");
				
				var ico = thisSig.getIcoNameByTag(value);
				var color = thisSig.getIcoColorByTag(value);
				
				//var itemName = this;
				if(!$(thisSig.cssModuleName + ' #item_panel_map_' + valueId).length){ //on le rajoute...
					var newItem = "<button class='item_panel_map' id='item_panel_map_" + valueId + "'>" +
								     "<i class='fa fa-"+ ico + ' fa-'+ color + "'></i> " + value +
								   "</button>";
					$('.panel_map').append(newItem);
					$(thisSig.cssModuleName + ' #item_panel_map_' + valueId).click(function(){ 
						thisSig.changeFilter(value, thisMap);
					});
					//alert('len : ' + $('#item_panel_map_' + item).length);
					//alert(newItem);
				}
				
			});
		};
			
		
		//##
		//##	LOAD MAP	##
		//##
		
		//##
		//chargement de la carte 
	 	this.Sig.loadMap = function(canvasId)
	 	{ 
			$("#"+canvasId).html("");
			$("#"+canvasId).css({"background-color": "#456074"});

			//initialisation des variables de départ de la carte
			var map = L.map(canvasId, { "zoomControl" : false, 
										"scrollWheelZoom":true, 
										"center" : [51.505, -0.09],
										"zoom" : 4,
										"worldCopyJump" : false });
	
			var tileLayer = L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
				//attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
				attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>',
				subdomains: 'abcd',
				minZoom: 0,
				maxZoom: 20
			}).setOpacity(0.4).addTo(map);
						
			return map;
		};	
		
		


		//alert((this.Sig));
		this.Sig = this.getSigInitializer(this.Sig);
		this.Sig = this.getSigRightList(this.Sig);
		this.Sig = this.getSigPopupContent(this.Sig);
			
		return this.Sig;	
	};
	